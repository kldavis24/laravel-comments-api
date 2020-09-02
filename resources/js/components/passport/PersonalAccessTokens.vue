<template>
    <div>
        <div class="bg-90 flex flex-col items-center justify-center">
            <div class="flex items-center justify-between">
                <span class="text-2xl">Personal API Tokens</span>
            </div>
            <!-- Personal Access Tokens -->
            <table v-if="tokens.length > 0" class="table-cell">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Created</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Expires</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="(token,index) in tokens" :key="index">
                    <td class="text-left py-3 px-4">{{ token.name }}</td>
                    <td class="text-left py-3 px-4">{{ token.created_at }}</td>
                    <td class="text-left py-3 px-4">{{ token.expires_at }}</td>
                    <td class="text-center py-3 px-4">
                        <span><i class="cursor-pointer text-red-600 fas fa-trash" @click="revoke(token)"/></span>
                    </td>
                </tr>
                </tbody>
            </table>
            <!-- No Tokens Notice -->
            <div v-else role="alert" class="mb-20 pt-5">
                <div class="bg-blue text-white font-bold rounded-t px-4 py-2">Oops!</div>
                <div class="border border-t-0 border-blue-light rounded-b bg-blue-lightest px-4 py-3 text-blue-dark">
                    <p>You Dont Have Any Personal Tokens Yet. Please Create a New Personal Token</p>
                </div>
            </div>
            <button
                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded"
                @click="showCreateTokenForm"
            >Create New Token</button>
        </div>

        <!-- Create Token Modal -->
        <div v-if="showCreateModal">
            <div class="fixed pin w-full flex items-center">
                <div class="fixed pin bg-black opacity-75 z-10"/>

                <div class="relative mx-6 md:mx-auto w-full md:w-1/2 lg:w-1/3 z-20 m-8">
                    <div class="shadow-lg bg-white rounded-lg p-8">
                        <div class="flex justify-end mb-6">
                            <button @click="showCreateModal = false">
                                <span><i class="text-red-600 fas fa-times"/></span>
                            </button>
                        </div>

                        <h1 class="text-center text-2xl text-blue-dark">Create Token</h1>

                        <form class="pt-6 pb-2 my-2" @submit.prevent="store">
                            <div class="mb-4">
                                <label class="block text-sm font-bold mb-2" for="name">Name</label>
                                <input
                                    id="name"
                                    v-model="form.name"
                                    :class="{ 'border-red': form.errors.has('name') }"
                                    class="block appearance-none outline-none w-full h-full border focus:border-blue bg-grey-lightest text-grey-darker py-3 pr-3 pl-9 rounded"
                                    placeholder=" Name Your Token"
                                    type="text"
                                    @keyup.enter="store"
                                >
                                <has-error :form="form" class="text-red" field="name"/>
                            </div>

                            <div v-if="scopes.length > 0" class="mb-4 flex flex-wrap">
                                <label class="w-full pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal font-bold -ml-4">Scopes</label>

                                <div class="w-full pr-4 pl-4">
                                    <div v-for="(scope,index) in scopes" :key="index">
                                        <div class="checkbox">
                                            <label>
                                                <input
                                                    :checked="scopeIsAssigned(scope.id)"
                                                    type="checkbox"
                                                    @click="toggleScope(scope.id)"
                                                >
                                                {{ scope.id }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block">
                                <div>
                                    <button
                                        class="float-right text-white bg-blue-600 hover:bg-blue-800 font-bold py-2 px-4 rounded border-b-4 border-blue-darkest"
                                        type="button"
                                        @click="store"
                                    >Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showAccessTokenModal">
            <div class="fixed pin w-full flex items-center">
                <div class="fixed pin bg-black opacity-75 z-10"/>

                <div class="relative mx-6 md:mx-auto w-full md:w-1/2 lg:w-1/3 z-20 m-8">
                    <div class="shadow-lg bg-white rounded-lg p-8">
                        <div class="flex justify-end mb-6">
                            <button @click="showAccessTokenModal = false">
                                <span><i class="text-red-600 fas fa-times"/></span>
                            </button>
                        </div>

                        <h1 class="text-center text-2xl text-teal-dark pb-5">Personal Access Token</h1>
                        <p class="text-justify text-grey-darker text-lg tracking-tight pb-5">
                            Here is your new personal access token. This is the only time it will be shown so don't lose it!
                            You may now use this token to make API requests.
                        </p>
                        <label>
                            <textarea
                                v-model="accessToken"
                                class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded"
                                rows="10"
                            />
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Access Token Modal -->
    </div>
</template>

<script>
import Form from 'vform'

export default {
    data: () => ({
        accessToken: null,
        tokens: [],
        scopes: [],
        form: new Form({
            name: '',
            scopes: []
        }),
        showCreateModal: false,
        showAccessTokenModal: false
    }),

    ready() {
        this.prepareComponent()
    },

    mounted() {
        this.prepareComponent()
    },

    methods: {
        prepareComponent() {
            this.getTokens()
            this.getScopes()
        },

        getTokens() {
            axios.get('/oauth/personal-access-tokens')
            .then(response => {
                this.tokens = response.data
            });
        },

        getScopes() {
            axios.get('/oauth/scopes')
            .then(response => {
                this.scopes = response.data
            });
        },

        showCreateTokenForm() {
            this.showCreateModal = true
        },

        store() {
            this.accessToken = null
            axios.post('/oauth/personal-access-tokens', this.form)
            .then(response => {
                this.form.name = ''
                this.form.scopes = []
                this.tokens.push(response.data.token)
                this.showCreateModal = false
                this.showAccessToken(response.data.accessToken)
            })
        },

        toggleScope(scope) {
            if (this.scopeIsAssigned(scope)) {
                this.form.scopes = _.reject(this.form.scopes, s => s === scope)
            } else {
                this.form.scopes.push(scope)
            }
        },

        scopeIsAssigned(scope) {
            return _.indexOf(this.form.scopes, scope) >= 0
        },

        showAccessToken(accessToken) {
            this.accessToken = accessToken
            this.showAccessTokenModal = true
        },

        revoke(token) {
            axios.delete(`/oauth/personal-access-tokens/${token.id}`)
            .then(response => {
                this.getTokens()
            })
        }
    }
};
</script>

<style scoped>
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
