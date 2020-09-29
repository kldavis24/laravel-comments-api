<template>
    <div class="bg-90 flex flex-col droid items-center justify-center">
        <div class="w-3/5 p-6">
            <div class="bg-grey-blue text-white p-2 rounded-lg">
                <div class="w-full pb-4">
                    <p class="text-teal-400 text-center text-2xl">
                        Comment Filters <span><i class="fas fa-filter text-base"></i></span>
                    </p>
                </div>
                <div class="flex w-full">
                    <div class="w-1/3 text-center pb-4">
                        <label v-bind:for="filteredEmail" class="block cursor-pointer pb-2"> Email</label>
                        <input class="w-half text-grey-blue" v-model="filteredEmail" type="text">
                    </div>
                    <div class="w-1/3 text-center pb-4">
                        <label v-bind:for="startDate" class="block cursor-pointer pb-2"> Start Date</label>
                        <input class="w-half text-grey-blue" id="startDate" v-model="startDate" type="date">
                    </div>
                    <div class="w-1/3 text-center pb-4">
                        <label v-bind:for="endDate" class="block cursor-pointer pb-2"> End Date</label>
                        <input class="w-half text-grey-blue" id="endDate" v-model="endDate" type="date">
                    </div>
                </div>
                <div class="w-full text-center">
                    <button class="bg-teal-400 hover:bg-teal-500 text-white font-bold py-2 px-4 rounded" v-if="datesActive" v-on:click="clearFilters">Clear Dates</button>
                </div>
            </div>
        </div>

        <h1 v-if="comments.length < 1" class="text-5xl text-grey-blue pt-20">
            Dang, no comments meet your criteria <i class="far fa-sad-tear"></i>
        </h1>

        <table v-else class="table-cell">
            <thead class="bg-grey-blue text-white">
            <tr>
                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Body</th>
                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Zip</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">State</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Image</th>
                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Approved</th>
                <th class="w-1/6 text-left py-3 px-4 uppercase font-semibold text-sm">Created</th>
            </tr>
            </thead>
            <tbody class="text-gray-700">
            <tr v-for="comment in comments">
                <td class="w-1/3 text-left py-3 px-4">{{comment.body}}</td>
                <td class="w-1/6 text-left py-3 px-4">{{comment.email}}</td>
                <td class="text-left py-3 px-4">{{comment.zip}}</td>
                <td class="text-center py-3 px-4">{{comment.state}}</td>
                <td class="text-center py-3 px-4">
                        <span v-if="comment.image_id">
                            <span class="image-preview" v-on:click="fetchCommentImage(comment.id)"><i class="fas fa-file-image"></i></span>
                        </span>
                    <span v-else><i class="fas fa-times-circle"></i></span>
                </td>
                <td class="text-left py-3 px-4">
                    <div class="flex items-center justify-center">
                        <label v-bind:for="comment.id" class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input v-bind:id="comment.id" v-on:click="toggleCommentApproval(comment.id)" type="checkbox" v-if="comment.approved === 1" checked class="hidden" />
                                <input v-bind:id="comment.id" v-on:click="toggleCommentApproval(comment.id)" type="checkbox" v-else class="hidden" />
                                <div class="toggle__line w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                <div class="toggle__dot absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"></div>
                            </div>
                        </label>
                    </div>
                </td>
                <td class="w-1/6 text-left py-3 px-4">{{comment.created_at | dateFormat}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "CommentList",

        data: () => ({
            startDate: '',
            endDate: '',
            filteredEmail: '',
            datesActive: false,
            comments: [],
        }),

        filters: {
            dateFormat: function(value) {
                return value.substring(0, value.indexOf('T'))
            }
        },

        watch: {
            filteredEmail() {
                this.filteredEmail !== '' ? this.filterCommentsByEmail(this.filteredEmail) : this.clearFilters()
            },

            startDate() {
                if (this.endDate !== '') {
                    this.filterCommentsByDate(this.startDate, this.endDate)
                    this.datesActive = true
                }
            },

            endDate() {
                if (this.startDate !== '') {
                    this.filterCommentsByDate(this.startDate, this.endDate)
                    this.datesActive = true
                }
            }
        },

        mounted() {
            this.fetchAllComments()
        },

        methods: {
            toggleCommentApproval(id) {
                axios.get(`/comments/${id}/toggle`)
                .then(response => {
                    let comment_id = response.data.id
                    let comment_approval = response.data.approved
                    let approval_status = comment_approval === 0 ? 'disapproved' : 'approved';

                    console.log(`Comment id ${comment_id} has been updated to: ${approval_status}!`);
                }).catch(error => {
                    console.error(`There was a problem toggling approval for comment id ${id} - ${error}`)
                })
            },

            fetchAllComments() {
                axios.get('/comments')
                .then(response => {
                    let comments = response.data
                    comments.forEach(comment => {
                        this.comments.push(comment)
                    })
                }).catch(error => {
                    console.error(`There was a problem fetching comments - ${error}`)
                })
            },

            fetchCommentImage(id) {
                axios.get(`/comments/${id}/image`)
                    .then(response => {
                        let image = response.data.name
                        window.open(`/images/${image}`, '_blank');
                    }).catch(error => {
                        console.error(error)
                })
            },

            filterCommentsByDate(start, end) {
                let startDate = start.toString()
                let endDate = end.toString()
                axios.get(`/comments/daterange/${startDate}/${endDate}`)
                .then(response => {
                    this.comments = []
                    let comments = response.data
                    comments.forEach(comment => {
                        this.comments.push(comment)
                    })
                }).catch(error => {
                    console.error(`There was a problem fetching comments via date query - ${error}`)
                })
                this.filterActive = true
            },

            filterCommentsByEmail(email) {
                axios.get(`/comments/${email}/email`)
                .then(response => {
                    this.comments = []
                    let comments = response.data
                    comments.forEach(comment => {
                        this.comments.push(comment)
                    })
                }).catch(error => {
                    console.error(`There was a problem fetching comments via email query - ${error}`)
                })
                this.filterActive = true
            },

            clearFilters() {
                this.startDate = null
                this.endDate = null
                this.comments = []
                this.fetchAllComments()
                this.datesActive = false
            },

            formatTodaysDate() {
                let today = new Date()
                let offset = today.getTimezoneOffset()
                today = new Date(today.getTime() + (offset*60*1000))
                return today.toISOString().split('T')[0]
            }
        }
    }
</script>

<style scoped>
    .toggle__dot {
        top: -.25rem;
        left: -.25rem;
        transition: all 0.3s ease-in-out;
    }
    input:checked ~ .toggle__dot {
        transform: translateX(100%);
        background-color: #4fd1c5;
    }
    input:focus {
        outline: none;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .image-preview:hover {
        cursor: pointer;
    }
    .fa-image,
    .fa-file-image {
        color: deepskyblue;
    }
    .fa-times-circle {
        color: crimson;
    }
</style>
