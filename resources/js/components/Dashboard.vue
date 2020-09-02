<template>
    <div>
        <div class="header w-full relative grid">
            <div class="header__bg w-full h-full top-0 left-0 absolute"></div>
            <h1 class="header__title uppercase">Comments Dashboard</h1>
        </div>

        <div class="about w-full">
            <div class="about__title text-center uppercase pt-24">
                <h2 class="about__title--text">New Comments This Week: {{ commentCount }}</h2>
            </div>
            <div class="about__text">
                <p class="about__text--content text-justify">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque officiis impedit exercitationem aperiam culpa repudiandae, architecto fugiat cumque dignissimos perferendis rerum eum aliquid assumenda consequatur aspernatur accusantium adipisci rem quasi!
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dashboard",

        data: () => ({
            commentCount: '',
        }),

        mounted() {
            this.fetchWeeklyComments()
        },

        methods: {
            fetchWeeklyComments() {
                axios.get('/comments/weekly')
                    .then(response => {
                        this.commentCount = response.data
                    }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>
    .header {
        height: 60vh;
        grid-template-rows: max-content 1fr;
        grid-template-columns: 1fr max-content;
    }
    .header__bg {
        background-image: url('/images/design/dashboard.png');
        background-size: cover;
        background-position: center;
        filter: brightness(80%);
        clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%);
        z-index: -1;
    }
    .header__title {
        grid-area: 2 / 1 / 2 / 3;
        align-self: center;
        justify-self: center;
        color: white;
        font-size: 4rem;
        text-shadow: 4px 2px 4px rgba(0, 0, 0, .4);
        margin-top: -5rem;
        font-family: "Droid Sans", system-ui, sans-serif;
        font-weight: 700;
        /*font-family: Nunito,system-ui,BlinkMacSystemFont,-apple-system,sans-serif;*/
    }
    .about {
        height: 45vh;
        margin-top: -7rem;
        clip-path: polygon(0 27%, 100% 0, 100% 100%, 0 100%);
        background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="4" height="4" viewBox="0 0 4 4"%3E%3Cpath fill="%239C92AC" fill-opacity="0.4" d="M1 3h1v1H1V3zm2-2h1v1H3V1z"%3E%3C/path%3E%3C/svg%3E');
    }
    .about__title--text {
        color: #232323;
    }
    .about__text {
        width: 80%;
        margin: 5% auto;
    }
</style>
