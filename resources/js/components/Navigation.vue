<template>
    <div class="hidden md:block">
        <div class="flex items-baseline">
            <a
                id="dashboard-nav"
                href="/"
                class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:underline"
                v-bind:class="{'underline': dashboardActive}"
            >
                Dashboard
            </a>
            <a
                id="comments-nav"
                href="/comments/all"
                class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:underline"
                v-bind:class="{'underline': commentsActive}"
            >
                Comments
            </a>
          <a
              id="docs-nav"
              href="/docs"
              class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:underline"
              v-bind:class="{'underline': docsActive}"
          >
            API Docs
          </a>
            <a
                id="tokens-nav"
                href="/tokens"
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

        data: () => ({
            dashboardActive: false,
            commentsActive: false,
            docsActive: false,
            tokensActive: false,
            currentPath: window.location.pathname
        }),

        mounted() {
            this.displayCurrentPage()
        },

        methods: {
            displayCurrentPage() {
                switch(this.currentPath) {
                    case '/comments/all':
                        this.commentsActive = true
                        break
                    case '/docs':
                        this.docsActive = true
                        break
                    case '/tokens':
                        this.tokensActive = true
                        break
                    case '/':
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
