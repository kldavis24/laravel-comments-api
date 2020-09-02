<template>
    <div>
        <div class="container-fluid docs-section text-center pt-6 pb-6 tracking-wide">
            <div class="docs__center text-left">
                <h3><span class="docs__post_color">POST</span> Register A New User</h3>
                <p class="docs__url_box mb-3 mt-1">{{ endpoint }}</p>
                <p class="mb-6">
                    Hitting this endpoint with the necessary form-data will create a new User in the system.
                </p>
                <p class="mb-2"><span class="docs__text_md underline">Headers</span></p>
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
                    </tbody>
                </table>
                <p class="mb-2"><span class="docs__text_md underline">Body</span> application/json</p>
                <table class="docs__table mb-6">
                    <tbody>
                    <tr>
                        <td class="docs__text_md">
                            { <br>
                                <span class="docs__curl_tab">"name": "Jane Doe",</span> <br>
                                <span class="docs__curl_tab">"email": "janedoe@example.com",</span> <br>
                                <span class="docs__curl_tab">"password": "secret",</span> <br>
                                <span class="docs__curl_tab">"password_confirmation": "secret"</span> <br>
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
                        -H <span class="docs__curl_string">"Accept: application/json"</span> \<br>
                        -H <span class="docs__curl_string">"Content-Type: application/json"</span> \<br>
                        -d <span class="docs__curl_string">'{<br>
                            <span class="docs__curl_tab2">"name": "Jane Doe",</span><br>
                            <span class="docs__curl_tab2">"email": "janedoe@example.com",</span><br>
                            <span class="docs__curl_tab2">"password": "secret",</span><br>
                            <span class="docs__curl_tab2">"password_confirmation": "secret",</span><br>
                        <span class="docs__curl_tab">}'</span></span>
                    </p>
                </div>
                <div v-if="visibleExample === 'phpVisible'" class="docs__curl_container">
                    <p class="docs__curl_example">
                        <span class="docs__php_method">public function <span class="docs__php_variable">registerNewUser</span><span class="docs__php_default">()<br> {</span></span><br>
                            <span class="docs__php_variable docs__curl_tab">$url</span><span class="docs__php_default"> = <span class="docs__php_string">'{{ url }}'</span>;</span><br>
                            <span class="docs__php_variable docs__curl_tab">$endpoint</span><span class="docs__php_default"> = <span class="docs__php_string">'api/signup'</span>;</span><br>
                            <span class="docs__php_variable docs__curl_tab">$full_path</span><span class="docs__php_default"> = </span><span class="docs__php_variable">$url<span class="docs__php_default"> . </span><span class="docs__php_string">'/'</span><span class="docs__php_default"> . </span>$endpoint</span><span class="docs__php_default"></span><span class="docs__php_default">;</span><br><br>
                            <span class="docs__php_variable docs__curl_tab">$headers</span><span class="docs__php_default"> = [<br>
                                <span class="docs__php_string docs__curl_tab2">'Content-Type: application/json'</span>,<br>
                                <span class="docs__php_string docs__curl_tab2">'Accept: application/json'</span>,<br>
                            <span class="docs__curl_tab">];</span></span><br><br>
                            <span class="docs__php_variable docs__curl_tab">$data <span class="docs__php_default"> = [ <br></span></span>
                                <span class="docs__php_string docs__curl_tab2">'name' <span class="docs__php_default"> => </span>'Jane Doe'<span class="docs__php_default">,</span></span><br>
                                <span class="docs__php_string docs__curl_tab2">'email' <span class="docs__php_default"> => </span>'janedoe@example.com'<span class="docs__php_default">,</span></span><br>
                                <span class="docs__php_string docs__curl_tab2">'password' <span class="docs__php_default"> => </span>'secret'<span class="docs__php_default">,</span></span><br>
                                <span class="docs__php_string docs__curl_tab2">'password_confirmation' <span class="docs__php_default"> => </span>'secret'<span class="docs__php_default">,</span></span><br>
                            <span class="docs__php_default docs__curl_tab">];</span><br><br>

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
                        <span class="docs__js_default"><span class="docs__js_method">registerNewUser</span>() {</span><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> url</span> = <span class="docs__js_string">'{{ url }}'</span></span><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> endpoint</span> = <span class="docs__js_string">'api/signup'</span></span><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> full_path</span> = <span class="docs__js_string">`</span>${<span class="docs__js_var">url</span>}<span class="docs__js_string">/</span>${<span class="docs__js_var">endpoint</span>}</span><span class="docs__js_string">`</span><br><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">const</span><span class="docs__js_var"> headers</span> = {</span><br>
                                <span class="docs__js_string docs__curl_tab2">'Content-Type'<span class="docs__js_default">: </span>'application/json'<span class="docs__js_default">,</span></span><br>
                                <span class="docs__js_string docs__curl_tab2">'Accept'<span class="docs__js_default">: </span>'application/json'<span class="docs__js_default">,</span></span><br>
                            <span class="docs__js_default docs__curl_tab">}</span><br><br>
                            <span class="docs__js_default docs__curl_tab"><span class="docs__js_variable italic">let</span><span class="docs__js_var"> data</span> = {</span><br>
                                <span class="docs__js_default docs__curl_tab2">name: <span class="docs__js_string">'Jane Doe'</span>,</span><br>
                                <span class="docs__js_default docs__curl_tab2">email: <span class="docs__js_string">'janedoe@example.com'</span>,</span><br>
                                <span class="docs__js_default docs__curl_tab2">password: <span class="docs__js_string">'secret'</span>,</span><br>
                                <span class="docs__js_default docs__curl_tab2">password_confirmation: <span class="docs__js_string">'secret'</span>,</span><br>
                            <span class="docs__js_default docs__curl_tab">}</span><br><br>
                            <span class="docs__js_axios docs__curl_tab italic">axios</span><span class="docs__js_default">.<span class="docs__js_variable">post</span>(<span class="docs__js_var">full_path</span>, <span class="docs__js_var">data</span>, {</span><br>
                                <span class="docs__js_default docs__curl_tab2">headers: <span class="docs__js_var">headers</span></span><br>
                            <span class="docs__js_default docs__curl_tab">}).<span class="docs__js_variable">then</span>(<span class="docs__js_variable italic">function</span>(<span class="docs__js_parameter">response</span>) {</span><br>
                                <span class="docs__js_variable docs__curl_tab2 italic">return <span class="docs__js_parameter">response</span></span><br>
                            <span class="docs__js_default docs__curl_tab">}).<span class="docs__js_variable">catch</span>(<span class="docs__js_variable italic">function</span>(<span class="docs__js_parameter">error</span>) {</span><br>
                                <span class="docs__js_default docs__curl_tab2"><span class="docs__js_variable italic">console</span>.<span class="docs__js_variable">log</span>(<span class="docs__js_string">`Registration error: <span class="docs__js_default">${<span class="docs__js_parameter">error</span>}`)</span></span></span><br>
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
        name: "UserSection",

        mounted() {
            console.log('UserSection component mounted!')
        },

        data: () => ({
            url: `https://${window.location.host}`,
            endpoint: '/api/signup',
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
