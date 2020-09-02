<template>
    <div>
        <section class="docs__section w-full">
            <docs-signup></docs-signup>
        </section>

        <section class="docs__section w-full">
            <docs-token></docs-token>
        </section>

        <section class="docs__section w-full">
            <docs-categories></docs-categories>
        </section>

        <section class="docs__section w-full">
            <docs-comment-post></docs-comment-post>
        </section>

        <section class="docs__section w-full">
            <docs-comment-get></docs-comment-get>
        </section>

        <section class="docs__section w-full">
            <docs-approved-comments></docs-approved-comments>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Docs"
    }
</script>

<style scoped>

</style>
