<template>
    <header class="header-container">
        <a href="/" class="logo-link">
            <img
                src="https://omgiva-prod.nyc3.cdn.digitaloceanspaces.com/websites/app/omgiva_logo_with_text_v4_600x144.png"
                class="logo-image"
            />
        </a>
    </header>
</template>

<script setup></script>

<style scoped>
.header-container {
    display: flex;
    align-items: center;
    padding: 3rem 0 2rem;
}

.logo-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #000;
}

.logo-image {
    max-width: 200px;
}
@media (max-width: 991px) {
    .header-container {
        padding: 0rem 0 2rem;
    }
}
</style>
