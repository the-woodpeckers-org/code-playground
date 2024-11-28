<template >
    <tr class="py-2 px-2 hover:bg-slate-300 hover:cursor-pointer" @click="click">
        <td class="underline"><router-link :to="'/profile/' +participant.user.id" target="_blank">{{ participant.user.name }}</router-link></td>
        <td>{{ finishedProblems }}</td>
        <td><router-link :to="'/View-User/'+participant.user.profileUser.id" target="_blank">View</router-link></td>
        <td>{{ participant.started_at }}</td>
    </tr>
</template>
<script>

export default {
    name: "Pariticipant",
    emits: ['click'],
    props: {
        participant:{},
        finishedProblems: {
            default: 0
        },
    },
    methods: {
        click(){
            this.$emit('click');
        }
    },
    mounted(){
        console.log(this.participant);
    },
}
</script>
<style >
    
</style>