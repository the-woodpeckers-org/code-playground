<template lang="">
        <tr >
            <td><a :href="`/Job-detail/${url}`" target="_blank" rel="noopener noreferrer" class="underline">{{ title }}</a></td>
            <td>{{ company }}</td>
            <td>{{ location }}</td>
            <td>{{ formattedDate}}</td>
            <td>{{ status }}</td>

         </tr>
</template>
<script>
import { format } from 'date-fns';
export default {

    name: 'JobAppliedItem',
    props: {
        title: String,
        company: String,
        location: String,
        applied_at: String,
        status: String,
        url: String,
    },
    computed: {
        formattedDate() {
            return format(new Date(this.applied_at), 'dd/MM/yyyy');
        }
    },
}
</script>
<style lang="" f>

</style>