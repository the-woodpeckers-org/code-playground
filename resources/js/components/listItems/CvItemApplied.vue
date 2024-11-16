<template>
    <tr>
        <td>{{ formattedTime }}</td>
        <td>{{ name }}</td>
        <td><a :href="linkCV" target="_blank">{{ linkCV }}</a></td>
        <td></td>
        <td></td>
    </tr>
</template>
<script>
export default {
    name: "CvItemApplied",
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
    }
}
</script>