<template >
    <tr class="py-2 px-2">
        <td>{{ participant.name }}</td>
        <td>{{ finishedProblems  }}</td>
        <td>{{ participant.profile_user.id }}</td>
        <td>{{ participatedAt }}</td>
    </tr>
</template>
<script>

export default {
    name: "Pariticipant",
    props: {
        participant:{},
        finishedProblems: {
            default: 0},
        participatedAt: {
            default: 0,
        }
    },
}
</script>
<style >
    
</style>