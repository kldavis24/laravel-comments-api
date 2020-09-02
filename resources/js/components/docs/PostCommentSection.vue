<template>
    <div>
        <div class="container-fluid text-center pt-6 pb-6">
            <div class="docs__center text-left">
                <h3><span class="docs__post_color">POST</span> Create Comment</h3>
                <p class="docs__url_box mt-1 mb-3">{{ endpoint }}</p>
                <p class="mb-6">
                    With the necessary JSON data, this route queues up the job to create a new Comment.
                </p>
                <p class="docs__text_md mb-2 underline">Headers</p>
                <table class="docs__table mb-6">
                    <tbody>
                    <tr>
                        <td class="docs__text_md">Accept</td>
                        <td>application/json</td>
                    </tr>
                    <tr>
                        <td class="docs__text_md">Content-Type</td>
                        <td>application/json</td>
                    </tr>
                    <tr>
                        <td class="docs__text_md">Authorization</td>
                        <td>Bearer {OAuth Token}</td>
                    </tr>
                    </tbody>
                </table>
                <p class="mb-2"><span class="docs__text_md underline">Body</span> application/json</p>
                <table class="docs__table mb-6">
                    <tbody>
                    <tr>
                        <td class="docs__text_md">
                            { <br>
                                <span class="docs__curl_tab">"body": "The body of the comment submitted by the user.",</span> <br>
                                <span class="docs__curl_tab">"email": "john.smith@example.com",</span> <br>
                                <span class="docs__curl_tab">"zip": "60660",</span> <br>
                                <span class="docs__curl_tab">"state": "IL",</span> <br>
                                <span class="docs__curl_tab">"categories": [</span> <br>
                                    <span class="docs__curl_tab2">{</span> <br>
                                        <span class="docs__curl_tab3">"title": "category_name",</span> <br>
                                    <span class="docs__curl_tab2">},</span> <br>
                                    <span class="docs__curl_tab2">{</span> <br>
                                        <span class="docs__curl_tab3">"title": "category_name",</span> <br>
                                    <span class="docs__curl_tab2">}</span> <br>
                                <span class="docs__curl_tab">],</span> <br>
                                <span class="docs__curl_tab">"image": null/base64 encoded,</span> <br>
                            }
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p class="mb-2"><span class="docs__text_md underline">Code Examples</span></p>
                <p class="mb-2">
                    <span id="cliVisible" class="text-blue-500 mr-4 hover:text-teal-500" v-on:click="showExample">Command Line</span>
                    <span id="phpVisible" class="text-blue-500 mr-4 hover:text-teal-500" v-on:click="showExample">PHP</span>
                    <span id="jsVisible" class="text-blue-500 mr-4 hover:text-teal-500" v-on:click="showExample">Javascript</span>
                </p>
                <div v-if="visibleExample === 'cliVisible'" class="docs__curl_container">
                    <p class="docs__curl_example">
                        curl -X POST <span class="docs__curl_string">"{{ url }}{{ endpoint }}"</span> \<br>
                        -H <span class="docs__curl_string">"Authorization: Bearer {token returned from login endpoint}"</span> \<br>
                        -H <span class="docs__curl_string">"Accept: application/json"</span> \<br>
                        -H <span class="docs__curl_string">"Content-Type: application/json"</span> \<br>
                        -d <span class="docs__curl_string">'{<br>
                            <span class="docs__curl_tab2">"body": "The body of the comment submitted by the user.",</span><br>
                            <span class="docs__curl_tab2">"email": "john.smith@example.com",</span><br>
                            <span class="docs__curl_tab2">"zip": "60660",</span><br>
                            <span class="docs__curl_tab2">"state": "IL",</span><br>
                            <span class="docs__curl_tab2">"categories": [</span><br>
                                <span class="docs__curl_tab3">{</span><br>
                                    <span class="docs__curl_tab4">"title": "category_name",</span><br>
                                <span class="docs__curl_tab3">},</span><br>
                                <span class="docs__curl_tab3">{</span><br>
                                    <span class="docs__curl_tab4">"title": "category_name",</span><br>
                                <span class="docs__curl_tab3">}</span><br>
                            <span class="docs__curl_tab2">],</span><br>
                            <span class="docs__curl_tab2">"image": null,</span><br>
                        <span class="docs__curl_tab">}</span>'</span>
                    </p>
                </div>
                <div v-if="visibleExample === 'phpVisible'" class="docs__curl_container">
                    <p class="docs__curl_example">
                        <span class="docs__php_method">public function <span class="docs__php_variable">createComment</span><span class="docs__php_default">()<br> {</span></span><br>
                            <span class="docs__php_variable docs__curl_tab">$url</span><span class="docs__php_default"> = <span class="docs__php_string">'{{ url }}'</span>;</span><br>
                            <span class="docs__php_variable docs__curl_tab">$endpoint</span><span class="docs__php_default"> = <span class="docs__php_string">'api/comments'</span>;</span><br>
                            <span class="docs__php_variable docs__curl_tab">$full_path</span><span class="docs__php_default"> = </span><span class="docs__php_variable">$url<span class="docs__php_default"> . </span><span class="docs__php_string">'/'</span><span class="docs__php_default"> . </span>$endpoint</span><span class="docs__php_default"></span><span class="docs__php_default">;</span><br>
                            <span class="docs__php_variable docs__curl_tab">$token</span><span class="docs__php_default"> = <span class="docs__php_function">env</span>(<span class="docs__php_string">'ACCESS_TOKEN'</span>);</span><br><br>
                            <span class="docs__php_variable docs__curl_tab">$headers</span><span class="docs__php_default"> = [<br></span>
                                <span class="docs__php_string docs__curl_tab2">'Content-Type: application/json'</span><span class="docs__php_default">,</span><br>
                                <span class="docs__php_string docs__curl_tab2">'Accept: application/json'</span><span class="docs__php_default">,</span><br>
                                <span class="docs__php_string docs__curl_tab2">'Authorization: Bearer '</span> . <span class="docs__php_variable"> $token</span><span class="docs__php_default">,</span><br>
                                <span class="docs__php_default docs__curl_tab">];</span><br><br>
                                <span class="docs__php_variable docs__curl_tab">$data <span class="docs__php_default"> = [ <br></span></span>
                                    <span class="docs__php_string docs__curl_tab2">'body' <span class="docs__php_default"> => </span>'The body of the comment submitted by the user.'<span class="docs__php_default">,</span></span><br>
                                    <span class="docs__php_string docs__curl_tab2">'email' <span class="docs__php_default"> => </span>'john.smith@example.com'<span class="docs__php_default">,</span></span><br>
                                    <span class="docs__php_string docs__curl_tab2">'zip' <span class="docs__php_default"> => </span>'60660'<span class="docs__php_default">,</span></span><br>
                                    <span class="docs__php_string docs__curl_tab2">'state' <span class="docs__php_default"> => </span>'IL'<span class="docs__php_default">,</span></span><br>
                                    <span class="docs__php_string docs__curl_tab2">'categories' <span class="docs__php_default"> => </span><span class="docs__php_default">[</span></span><br>
                                        <span class="docs__php_default docs__curl_tab3">[</span><br>
                                            <span class="docs__php_string docs__curl_tab4">'title' <span class="docs__php_default"> => </span>'category_name'</span><span class="docs__php_default">,</span><br>
                                        <span class="docs__php_default docs__curl_tab3">],</span><br>
                                    <span class="docs__php_default docs__curl_tab2">],</span><br>
                                    <span class="docs__php_string docs__curl_tab2">'image' <span class="docs__php_default"> => </span><span class="docs__php_null italic">null</span><span class="docs__php_default">,</span></span><br>
                            <span class="docs__php_default docs__curl_tab">]; <br><br></span>
                            <span class="docs__php_variable docs__curl_tab">$ch</span><span class="docs__php_default"> = </span><span class="docs__php_function">curl_init</span><span class="docs__php_default">();</span><br>
                            <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_setopt</span>(<span class="docs__php_variable">$ch</span>, <span class="docs__php_CURLOPT">CURLOPT_URL</span>, <span class="docs__php_variable">$full_path</span>);</span><br>
                            <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_setopt</span>(<span class="docs__php_variable">$ch</span>, <span class="docs__php_CURLOPT">CURLOPT_RETURNTRANSFER</span>, <span class="docs__php_CURLOPT">1</span>);</span><br>
                            <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_setopt</span>(<span class="docs__php_variable">$ch</span>, <span class="docs__php_CURLOPT">CURLOPT_HTTPHEADER</span>, <span class="docs__php_variable">$headers</span>);</span><br>
                            <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_setopt</span>(<span class="docs__php_variable">$ch</span>, <span class="docs__php_CURLOPT">CURLOPT_POST</span>, <span class="docs__php_CURLOPT">1</span>);</span><br>
                            <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_setopt</span>(<span class="docs__php_variable">$ch</span>, <span class="docs__php_CURLOPT">CURLOPT_POSTFIELDS</span>, <span class="docs__php_variable">$data</span>);</span><br>
                            <span class="docs__php_variable docs__curl_tab">$result<span class="docs__php_default"> = <span class="docs__php_function">curl_exec</span>(</span>$ch</span><span class="docs__php_default">);</span><br>
                            <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_close</span>(<span class="docs__php_variable">$ch</span>);</span><br><br>
                            <span class="docs__php_method docs__curl_tab">return <span class="docs__php_variable">$result</span></span><span class="docs__php_default">;</span><br>
                        <span class="docs__php_default">}</span>
                    </p>
                </div>
                <div v-if="visibleExample === 'jsVisible'" class="docs__curl_container">
                    <p class="docs__curl_example">
                        <span class="docs__js_comment">// Written in ES6 for React/Vue/Angular type applications</span><br>
                        <span class="docs__js_default"><span class="docs__js_method">createComment</span>() {</span><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> url</span> = <span class="docs__js_string">'{{ url }}'</span></span><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> endpoint</span> = <span class="docs__js_string">'api/comments'</span></span><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> full_path</span> = <span class="docs__js_string">`</span>${<span class="docs__js_var">url</span>}<span class="docs__js_string">/</span>${<span class="docs__js_var">endpoint</span>}</span><span class="docs__js_string">`</span><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> token</span> = process.env.ACCESS_TOKEN</span><br><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">const</span><span class="docs__js_var"> headers</span> = {</span><br>
                                <span class="docs__js_string docs__curl_tab2">'Content-Type'<span class="docs__js_default">: </span>'application/json'<span class="docs__js_default">,</span></span><br>
                                <span class="docs__js_string docs__curl_tab2">'Accept'<span class="docs__js_default">: </span>'application/json'<span class="docs__js_default">,</span></span><br>
                                <span class="docs__js_string docs__curl_tab2">'Authorization'<span class="docs__js_default">: </span>`Bearer <span class="docs__js_default">${<span class="docs__js_var">token</span>}</span>`</span><br>
                            <span class="docs__js_default docs__curl_tab">}</span><br><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> data</span> = {</span><br>
                                <span class="docs__js_default docs__curl_tab2">body: <span class="docs__js_string">'The body of the comment submitted by the user.'</span>,</span><br>
                                <span class="docs__js_default docs__curl_tab2">email: <span class="docs__js_string">'john.smith@example.com'</span>,</span><br>
                                <span class="docs__js_default docs__curl_tab2">zip: <span class="docs__js_string">'60660'</span>,</span><br>
                                <span class="docs__js_default docs__curl_tab2">state: <span class="docs__js_string">'IL'</span>,</span><br>
                                <span class="docs__js_default docs__curl_tab2">categories: [</span><br>
                                    <span class="docs__js_default docs__curl_tab3">{ title: <span class="docs__js_string">'category_name'</span> }</span><br>
                                <span class="docs__js_default docs__curl_tab2">]</span><br>
                                <span class="docs__js_default docs__curl_tab2">image: <span class="docs__js_string"><span class="docs__js_null italic">null</span></span>,</span><br>
                            <span class="docs__js_default docs__curl_tab">}</span><br><br>
                            <span class="docs__js_axios docs__curl_tab italic">axios</span><span class="docs__js_default">.<span class="docs__js_variable">post</span>(<span class="docs__js_var">full_path</span>, <span class="docs__js_var">data</span>, {</span><br>
                                <span class="docs__js_default docs__curl_tab2">headers: <span class="docs__js_var">headers</span></span><br>
                            <span class="docs__js_default docs__curl_tab">}).<span class="docs__js_variable">then</span>(<span class="docs__js_variable italic">function</span>(<span class="docs__js_parameter">response</span>) {</span><br>
                                <span class="docs__js_variable docs__curl_tab2 italic">return <span class="docs__js_parameter">response</span></span><br>
                            <span class="docs__js_default docs__curl_tab">}).<span class="docs__js_variable">catch</span>(<span class="docs__js_variable italic">function</span>(<span class="docs__js_parameter">error</span>) {</span><br>
                                <span class="docs__js_default docs__curl_tab2"><span class="docs__js_variable italic">console</span>.<span class="docs__js_variable">log</span>(<span class="docs__js_string">`Error sending SMS: <span class="docs__js_default">${<span class="docs__js_parameter">error</span>}`)</span></span></span><br>
                                <span class="docs__js_variable docs__curl_tab2 italic">return <span class="docs__js_parameter">error</span></span><br>
                            <span class="docs__js_default docs__curl_tab">})</span><br>
                        <span class="docs__js_default">}</span>
                    </p>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    name: "PostCommentsSection",

    mounted() {
        console.log('PostCommentsSection component mounted!')
    },

    data: () => ({
        url: `https://${window.location.host}`,
        endpoint: '/api/comments',
        visibleExample: ''
    }),

    methods: {
        showExample(event) {
            this.visibleExample = event.target.id
        }
    }
}
</script>

<style scoped></style>
