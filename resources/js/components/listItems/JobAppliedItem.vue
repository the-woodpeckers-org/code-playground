<template lang="">
        <tr >
                        <td>{{ title}}</td>
                        <td>{{ company }}</td>
                        <td>{{ location }}</td>
                        <td>{{ formattedDate}}</td>
                        <td>
                            <button class="btn btn-primary">View</button>
                        </td>
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
            applied_at: String
    },
    computed: {
        formattedDate() {
            return format(new Date(this.applied_at), 'dd/MM/yyyy');
        }
    },
}
</script>
<style lang=""f>
    
</style>