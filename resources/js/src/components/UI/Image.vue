<template>
    <img  :class="style" :src="getUrlImg(img)" :alt="alt" :title="title" />
</template>

<script>
export default {
    name: "Image",
    props: {
        img: {
            type: String,
            required: true
        },
        alt: {
            type: String,
            default: ""
        },
        title: {
            type: String,
            default: ""
        },
        style: {
            type: String,
            default: ""
        },
    },

    methods: {
        getUrlImg(img) {
            const imgUrl = import.meta.env.VITE_APP_URL  + "/build/assets/img/" + img
            return new URL(imgUrl, import.meta.url).href
        }
    }
}
</script>

