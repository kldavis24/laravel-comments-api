<?php

namespace App\Http\Controllers;

use App\Image;
use App\Comment;
use App\Category;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use App\CommentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateCommentRequest;
use Intervention\Image\ImageManagerStatic as LocalImage;

class CommentController extends Controller
{
    /**
     * Display a listing of every Comment.
     *
     * @return Comment[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * Display the Vue component with an initial listing
     * of all available Comments.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function display()
    {
        return view('comments.comment-list');
    }

    /**
     * Display a listing of all approved comments.
     *
     * @return mixed
     */
    public function approved()
    {
    	return Comment::where('approved', true)->get();
    }

    /**
     * Return the dashboard view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    /**
     * Return the Image object attached to the
     * Comment, or null if no image exists.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function fetchCommentImageById($id)
    {
        return Comment::find($id)->image;
    }

	/**
	 * Store a newly created Comment in storage.
	 *
	 * @param CreateCommentRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function store(CreateCommentRequest $request)
    {
	    $json_data = json_decode($request->getContent(), true);

	    $comment = Comment::create([
		    'body' => $json_data['body'],
		    'email' => $json_data['email'],
		    'zip' => $json_data['zip'],
		    'state' => $json_data['state'],
	    ]);

	    if ($json_data['image']) {
		    $local_image = $this->saveBase64Image($json_data['image']);
		    $comment_image = $this->createCommentImage($comment, $local_image);
	    }

	    foreach ($request->categories as $category) {
		    $category_id = Category::where('title', $category['title'])->take(1)->get('id');

		    if ($category_id->isEmpty()) {
			    $this->destroy($comment);
			    return response()->json(['error' => 'Comment not created. Attempted to find Category title unsuccessfully: ' . $category['title']], 403);
		    }

		    CommentCategory::create([
			    'category_id' => $category_id[0]['id'],
			    'comment_id' => $comment->id,
			    'created_at' => Carbon::now(),
			    'updated_at' => Carbon::now()
		    ]);
	    }

	    return response()->json(['success' => 'New comment created! Comment id: ' . $comment->id], 200);
    }

    /**
     * Validation of the Authentication header from the incoming request.
     *
     * @param $request
     *
     * @return bool
     */
//    public function validateAuthentication($request)
//    {
//        $auth = $request->header('Authorization');
//        $decoded = base64_decode(substr($auth, 6));
//
//        if ($decoded == config('services.comment.authorization')) {
//            return true;
//        }
//        return false;
//    }

    /**
     * Save the base64 encoded image locally before sending
     * it off to the s3 bucket.
     *
     * @param $image
     *
     * @return array
     */
    public function saveBase64Image($image)
    {
        // Grab the mime type out of the base64 encoded string
        $image_type = explode('/', mime_content_type($image))[1];
        $image_name = Uuid::uuid() . '.' . $image_type;
        LocalImage::make($image)->save(public_path() . '/images/' . $image_name);

        return [
            'image_name' => $image_name,
            'image_type' => $image_type
        ];
    }

    /**
     * Create an Image object connected to the newly-created Comment.
     *
     * @param $comment
     * @param $image_data
     *
     * @return bool
     */
    public function createCommentImage($comment, $image_data)
    {
        try {
            $image = Image::create([
                'name' => $image_data['image_name'],
                'comment_id' => $comment->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $comment->image_id = $image->id;
            $comment->save();
            return true;
        } catch(\Exception $e) {
            Log::error('Error attempting to create image for comment_id ' . $comment->id . ': ' . $e);
            return false;
        }
    }

    /**
     * Toggle the approval field of the selected
     * Comment by id.
     *
     * @param $id
     *
     * @return Comment[]|\Illuminate\Database\Eloquent\Collection
     */
    public function toggleCommentApproval($id)
    {
        $comment = Comment::find($id);
        $comment->approved == 0 ? $comment->approved = 1 : $comment->approved = 0;
        $comment->is_moderated = 1;
        $comment->save();

        return $comment;
    }

    /**
     * Returns the number of new Comments this week
     * for a display on the dashboard
     *
     * @return int
     */
    public function getThisWeeksComments()
    {
        $fromDate = Carbon::now()->subWeeks(1);
        $tillDate = Carbon::now();
        $comments = $this->returnCommentsBetweenDates($fromDate, $tillDate);

        return count($comments);
    }

    /**
     * Query the database for Comments between creation dates.
     *
     * @param $beginning
     * @param $end
     *
     * @return Comment[]|\Illuminate\Database\Eloquent\Collection
     */
    public function returnCommentsBetweenDates($beginning, $end)
    {
        return Comment::whereBetween(DB::raw('DATE(created_at)'), [$beginning, $end])->get();
    }

    /**
     * Query the database for Comments with emails similar
     * to the entered parameter.
     *
     * @param $email
     *
     * @return mixed
     */
    public function returnCommentsWithSimilarEmails($email)
    {
        return Comment::where('email', 'like', $email . '%')->get();
    }

    /**
     * Display the specified Comment.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return Comment::find($comment->id);
    }

    /**
     * Remove the specified Comment from storage.
     *
     * @param \App\Comment $comment
     *
     * @return bool
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}
