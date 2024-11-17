<template>
    <tr>
        <td>{{ formattedTime }}</td>
        <td> <a :href="`/View-User/${id_user}`" target="_blank">{{ name }}</a></td>
        <td><a :href="linkCV" target="_blank">{{ linkCV }}</a></td>
        <td><i class="fa-solid fa-trash hover:text-red-500"></i></td>
        <td></td>
    </tr>
</template>
<script>
export default {
    name: "CvItemApplied",
    emits: ['delete'],
    props: {
        name: {
            type: String,
            default: 'N/A'
        },
        time: {
            type: String,
            default: 'N/A'
        },
        id_cv: {
            type: String,
            default: 0
        },
        id_user: {
            type: String,
            default: 0
        },
        linkCV: {
            type: String,
            default: 'N/A'
        },
    },
    computed: {
        formattedTime() {
            if (this.time === 'N/A') return 'N/A';
            const date = new Date(this.time);
            return date.toLocaleString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            });
        }
    },
    methods: {
        deleteCv() {
            this.$emit('delete', this.id_cv);
        }
    }
}
</script>