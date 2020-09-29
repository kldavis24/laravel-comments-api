<template>
    <div class="hidden md:block">
        <div class="flex items-baseline">
            <a
                id="dashboard-nav"
                :href="this.dashboard"
                class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:underline"
                v-bind:class="{'underline': dashboardActive}"
            >
                Dashboard
            </a>
            <a
                id="comments-nav"
                :href="this.comments"
                class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:underline"
                v-bind:class="{'underline': commentsActive}"
            >
                Comments
            </a>
            <a
                id="docs-nav"
                :href="this.docs"
                class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:underline"
                v-bind:class="{'underline': docsActive}"
            >
                API Docs
            </a>
            <a
                id="tokens-nav"
                :href="this.tokens"
                class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:underline"
                v-bind:class="{'underline': tokensActive}"
            >
                Tokens
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Navigation",

        props: [
            'login',
            'logout',
            'docs',
            'dashboard',
            'tokens',
            'comments',
        ],

        data: () => ({
            dashboardActive: false,
            commentsActive: false,
            docsActive: false,
            tokensActive: false,
            currentPath: window.location.href,
        }),

        mounted() {
            this.displayCurrentPage()
        },

        methods: {
            displayCurrentPage() {
                switch(this.currentPath) {
                    case this.comments:
                        this.commentsActive = true
                        break
                    case this.docs:
                        this.docsActive = true
                        break
                    case this.tokens:
                        this.tokensActive = true
                        break
                    case `${this.dashboard}/`:
                        this.dashboardActive = true
                        break;
                }
            }
        }
    }
</script>

<style scoped>
    a {
        font-family: "Droid Sans", system-ui, sans-serif;
        font-weight: 600;
    }
</style>
