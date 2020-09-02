<template>
    <div>
        <div class="container-fluid text-center pt-6 pb-6 tracking-wide">
            <div class="docs__center text-left">
                <h3><span class="docs__get_color">GET</span> Return A List Of Approved Comments</h3>
                <p class="docs__url_box bt-1 mb-2">{{ endpoint }}</p>
                <p class="mb-6">
                    This will return a list of all currently approved Comments.
                </p>
                <p class="docs__text_md mb-2"><u>Headers</u></p>
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
                <p class="mb-2"><span class="docs__text_md underline">Code Examples</span></p>
                <p class="mb-2">
                    <span id="cliVisible" class="text-blue-500 mr-4 hover:text-teal-500" v-on:click="showExample">Command Line</span>
                    <span id="phpVisible" class="text-blue-500 mr-4 hover:text-teal-500" v-on:click="showExample">PHP</span>
                    <span id="jsVisible" class="text-blue-500 mr-4 hover:text-teal-500" v-on:click="showExample">Javascript</span>
                </p>
                <div v-if="visibleExample === 'cliVisible'" class="docs__curl_container">
                    <p class="docs__curl_example">
                        curl -X GET <span class="docs__curl_string">"{{ url }}{{ endpoint }}"</span> \<br>
                        -H <span class="docs__curl_string">"Accept: application/json"</span> \<br>
                        -H <span class="docs__curl_string">"Content-Type: application/json"</span> \<br>
                        -H <span class="docs__curl_string">"Authorization: Bearer {token returned from login endpoint}"</span><br>
                    </p>
                </div>
                <div v-if="visibleExample === 'phpVisible'" class="docs__curl_container">
                    <p class="docs__curl_example">
                        <span class="docs__php_method">public function <span class="docs__php_variable">getApprovedComments</span><span class="docs__php_default">()<br> {</span></span><br>
                        <span class="docs__php_variable docs__curl_tab">$url</span><span class="docs__php_default"> = <span class="docs__php_string">'{{ url }}'</span>;</span><br>
                        <span class="docs__php_variable docs__curl_tab">$endpoint</span><span class="docs__php_default"> = <span class="docs__php_string">'api/approved'</span>;</span><br>
                        <span class="docs__php_variable docs__curl_tab">$full_path</span><span class="docs__php_default"> = </span><span class="docs__php_variable">$url<span class="docs__php_default"> . </span><span class="docs__php_string">'/'</span><span class="docs__php_default"> . </span>$endpoint</span><span class="docs__php_default"></span><span class="docs__php_default">;</span><br>
                        <span class="docs__php_variable docs__curl_tab">$token</span><span class="docs__php_default"> = <span class="docs__php_function">env</span>(<span class="docs__php_string">'ACCESS_TOKEN'</span>);</span><br><br>
                        <span class="docs__php_variable docs__curl_tab">$headers</span><span class="docs__php_default"> = [<br>
                                <span class="docs__php_string docs__curl_tab2">'Content-Type: application/json'</span>,<br>
                                <span class="docs__php_string docs__curl_tab2">'Accept: application/json'</span>,<br>
                                <span class="docs__php_string docs__curl_tab2">'Authorization: Bearer '</span> . <span class="docs__php_variable"> $token</span><span class="docs__php_default">,</span><br>
                            <span class="docs__curl_tab">];</span></span><br><br>
                        <span class="docs__php_variable docs__curl_tab">$ch</span><span class="docs__php_default"> = </span><span class="docs__php_function">curl_init</span><span class="docs__php_default">();</span><br>
                        <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_setopt</span>(<span class="docs__php_variable">$ch</span>, <span class="docs__php_CURLOPT">CURLOPT_URL</span>, <span class="docs__php_variable">$full_path</span>);</span><br>
                        <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_setopt</span>(<span class="docs__php_variable">$ch</span>, <span class="docs__php_CURLOPT">CURLOPT_RETURNTRANSFER</span>, <span class="docs__php_CURLOPT">1</span>);</span><br>
                        <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_setopt</span>(<span class="docs__php_variable">$ch</span>, <span class="docs__php_CURLOPT">CURLOPT_HTTPHEADER</span>, <span class="docs__php_variable">$headers</span>);</span><br>
                        <span class="docs__php_variable docs__curl_tab">$result<span class="docs__php_default"> = <span class="docs__php_function">curl_exec</span>(</span>$ch</span><span class="docs__php_default">);</span><br>
                        <span class="docs__php_default docs__curl_tab"><span class="docs__php_function">curl_close</span>(<span class="docs__php_variable">$ch</span>);</span><br><br>
                        <span class="docs__php_method docs__curl_tab">return <span class="docs__php_variable">$result</span></span><span class="docs__php_default">;</span><br>
                        <span class="docs__php_default">}</span>
                    </p>
                </div>
                <div v-if="visibleExample === 'jsVisible'" class="docs__curl_container">
                    <p class="docs__curl_example">
                        <span class="docs__js_comment">// Written in ES6 for React/Vue/Angular type applications</span><br>
                        <span class="docs__js_default"><span class="docs__js_method">getApprovedComments</span>() {</span><br>
                        <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> url</span> = <span class="docs__js_string">'{{ url }}'</span></span><br>
                        <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> endpoint</span> = <span class="docs__js_string">'api/approved'</span></span><br>
                        <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> full_path</span> = <span class="docs__js_string">`</span>${<span class="docs__js_var">url</span>}<span class="docs__js_string">/</span>${<span class="docs__js_var">endpoint</span>}</span><span class="docs__js_string">`</span><br>
                        <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> token</span> = process.env.ACCESS_TOKEN</span><br><br>
                        <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">const</span> headers = {</span><br>
                        <span class="docs__js_string docs__curl_tab2">'Content-Type'<span class="docs__js_default">: </span>'application/json'<span class="docs__js_default">,</span></span><br>
                        <span class="docs__js_string docs__curl_tab2">'Accept'<span class="docs__js_default">: </span>'application/json'<span class="docs__js_default">,</span></span><br>
                        <span class="docs__js_string docs__curl_tab2">'Authorization'<span class="docs__js_default">: </span>`Bearer <span class="docs__js_default">${<span class="docs__js_var">token</span>}</span>`<span class="docs__js_default">,</span></span><br>
                        <span class="docs__js_default docs__curl_tab">}</span><br><br>
                        <span class="docs__js_axios docs__curl_tab italic">axios</span><span class="docs__js_default">.<span class="docs__js_variable">post</span>(<span class="docs__js_var">full_path</span>, <span class="docs__js_var">data</span>, {</span><br>
                        <span class="docs__js_default docs__curl_tab2">headers: <span class="docs__js_var">headers</span></span><br>
                        <span class="docs__js_default docs__curl_tab">}).<span class="docs__js_variable">then</span>(<span class="docs__js_variable italic">function</span>(<span class="docs__js_parameter">response</span>) {</span><br>
                        <span class="docs__js_variable docs__curl_tab2 italic">return <span class="docs__js_parameter">response</span></span><br>
                        <span class="docs__js_default docs__curl_tab">}).<span class="docs__js_variable">catch</span>(<span class="docs__js_variable italic">function</span>(<span class="docs__js_parameter">error</span>) {</span><br>
                        <span class="docs__js_default docs__curl_tab2"><span class="docs__js_variable italic">console</span>.<span class="docs__js_variable">log</span>(<span class="docs__js_string">`User fetch error: <span class="docs__js_default">${<span class="docs__js_parameter">error</span>}`)</span></span></span><br>
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
    name: "ApprovedCommentsSection",

    mounted() {
        console.log('ApprovedCommentsSection component mounted!')
    },

    data: () => ({
        url: `https://${window.location.host}`,
        endpoint: '/api/approved',
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
