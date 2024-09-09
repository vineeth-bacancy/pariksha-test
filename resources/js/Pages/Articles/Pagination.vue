<template>
    <div class="pagination" v-if="meta">
        <div>
            <p class="info">
                Showing <span>{{ meta.from }}</span> to
                <span>{{ meta.to }}</span> of
                <span>{{ meta.total }}</span> results
            </p>
        </div>
        <div class="buttons">
            <button
                :disabled="meta.current_page === 1"
                class="previous arrow"
                @click="$emit('changePage', meta.current_page - 1)"
            ></button>
            <button
                v-for="page in pages"
                :key="page"
                @click="$emit('changePage', page)"
                :class="{ active: page === meta.current_page }"
            >
                {{ page }}
            </button>
            <button
                class="next arrow"
                :disabled="meta.current_page === meta.last_page"
                @click="$emit('changePage', meta.current_page + 1)"
            ></button>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
const props = defineProps({
    meta: Object,
});

const pages = computed(() => {
    const range = [];
    for (let i = 1; i <= props.meta.last_page; i++) {
        range.push(i);
    }
    return range;
});
</script>

<style scoped>
.pagination {
    display: flex;
    margin-top: 1rem;
    margin-bottom: 4rem;
    justify-content: space-between;
    align-items: center;
    width: 50%;
    font-family: "Figtree", "Ubuntu", sans-serif;
}

.pagination .info {
    font-size: 0.875rem;
    line-height: 1.5;
    opacity: 1;
    color: #6c757d;
}

.pagination .info span {
    font-weight: 600;
}

.pagination .buttons {
    display: flex;
    /* margin-block-end: 1rem; */
}

.pagination button {
    padding: 0.375rem 0.75rem;
    background-color: #fff;
    color: #007bff;
    border: 1px solid transparent;
    border-top: 1px solid #dee2e6;
    border-bottom: 1px solid #dee2e6;
    cursor: pointer;
}

.pagination button:not(:last-child) {
    border-right: 1px solid #dee2e6;
}

.pagination button[disabled] {
    color: #6c757d;
}

.pagination button.active {
    font-weight: bold;
    background-color: #007bff;
    color: white;
    border-top: 1px solid #007bff;
    border-bottom: 1px solid #007bff;
}

.pagination button.previous {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
    border-left: 1px solid #dee2e6;
}

.pagination button.next {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
    border-right: 1px solid #dee2e6;
}

.pagination button.arrow::before {
    content: "";
    display: inline-block;
    margin-right: 0em;
}

.pagination button.previous::before {
    content: "‹";
}

.pagination button.next::before {
    content: "›";
}

.pagination button:not(.active):not([disabled]):hover {
    background-color: #e9ecef;
}

@media (max-width: 575px) {
    .pagination {
        display: flex;
        align-items: start;
        justify-content: left;
        width: 100%;
    }
    .pagination button.previous::before {
        content: "« Previous";
    }

    .pagination button.next::before {
        content: "Next »";
    }

    .pagination .info {
        display: none;
    }

    .pagination button:not(.previous):not(.next) {
        display: none;
    }
}
</style>
