<template>
    <div class="container">
        <Header />
        <main class="main">
            <div v-if="loading" class="loading">Loading articles...</div>
            <div v-else>
                <article
                    v-for="article in articles"
                    :key="article.id"
                    class="article"
                >
                    <small class="category">{{ article.category }}</small>
                    <h2 class="title">{{ article.title }}</h2>
                    <div class="meta">
                        <span class="meta-item">
                            <!-- <i class="icon icon-clock"></i> -->
                            <img class="icon" :src="clockIcon" />

                            <!-- TimeAgo Component -->
                            <TimeAgo :date="article.created_at" />
                        </span>
                        <span class="meta-item">
                            <!-- <i class="icon icon-person"></i> -->
                            <img class="icon" :src="personIcon" />
                            <a href="#" class="author">
                                {{ article.author }}
                            </a>
                        </span>
                        <!-- <div class="meta-item tags"> -->
                        <span
                            v-if="article.tags && article.tags.length"
                            v-for="tag in article.tags"
                            :key="tag"
                            class="meta-item tag"
                        >
                            <!-- <i class="icon icon-tag info"></i> -->
                            <img class="icon" :src="tagIcon" />
                            <span>{{ tag }}</span>
                        </span>
                        <!-- </div> -->
                    </div>
                    <hr />
                    <p class="content">
                        This is some additional paragraph placeholder content.
                        It has been written to fill the available space and show
                        how a longer snippet of text affects the surrounding
                        content. We'll repeat it often to keep the demonstration
                        flowing, so be on the lookout for this exact same string
                        of text.
                    </p>
                </article>

                <!-- Pagination Component -->
                <Pagination :meta="meta" @changePage="fetchArticles" />
                <hr />
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Pagination from "./Pagination.vue";
import TimeAgo from "./TimeAgo.vue";
import Header from "./Header.vue";

import clockIcon from "./images/clock.svg";
import personIcon from "./images/person.svg";
import tagIcon from "./images/tag.svg";

const articles = ref([]);
const meta = ref(null);
const loading = ref(true);

const fetchArticles = (page = 1) => {
    loading.value = true;
    axios
        .get(`/api/articles?page=${page}`)
        .then((response) => {
            articles.value = response.data.data;
            meta.value = response.data.meta;
        })
        .catch((error) => {
            console.error(error);
        })
        .finally(() => {
            loading.value = false;
        });
};

onMounted(() => {
    fetchArticles();
});
</script>

<style scoped>
.container {
    padding: 0 1.5rem;
    margin: 0 auto;
    width: 50%;
}

.main {
    min-height: 100vh;
    padding: 0 0 8rem 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.article {
    font-family: "Ubuntu", sans-serif;
}

.category {
    color: #198754;
    font-weight: bold;
    font-size: 0.875em;
    opacity: 0.5;
}

.title {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    font-weight: 700;
    line-height: 1.2;
}

.meta {
    font-size: 0.875em;
    height: 1.5rem !important;
    color: #6c757d;
}

.meta-item {
    display: inline-flex;
    align-items: center;
    flex-wrap: wrap;
    margin-right: 0.8rem;
    padding-top: 0.2rem;
}

.tag {
    display: inline-flex;
    margin-right: 0.2em;
    align-items: center;
}

.icon {
    display: inline-block;
    font-size: 0.875em !important;
    line-height: 1;
    align-content: space-around !important;
    margin-right: 0.2rem;
    color: #0dcaf0 !important;
    vertical-align: -125em !important;

    --icon-color: #0dcaf0 !important;
}

.info {
    color: #0dcaf0;
    font-weight: bold;
}
.icon::before {
    font-size: 0.6rem;
    font-style: normal;
}

.icon-clock::before {
    font-size: 0.6rem;
    content: "🕒";
    /* content: "\f293"; */
}
.icon-person::before {
    content: "👤";
    /* content: "\f4e1"; */
}
.icon-tag::before {
    content: "🏷️";
    /* content: "\f5b0"; */
}

.author {
    color: inherit;
    text-decoration: none;
}

hr {
    margin: 1rem 0;
    border: 0;
    border-top: 1px solid #dee2e6;
}

.content {
    margin-bottom: 1rem;
    font-size: 1rem;
}

.loading {
    text-align: center;
    font-size: 1.25rem;
    color: #6c757d;
}

@media (max-width: 991px) {
    .container {
        width: 100%;
        padding: 1.5rem;
    }
    .main {
        padding-bottom: 5rem;
    }
    .meta {
        /* display: block; */
        /* margin-bottom: 2.5rem; */
    }
    .title {
        font-size: calc(1.325rem + 0.9vw);
    }
}
</style>
