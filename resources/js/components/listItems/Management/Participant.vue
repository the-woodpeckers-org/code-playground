<template>
    <tr class="py-2 px-2 hover:bg-slate-300 hover:cursor-pointer" @click="click">
        <td class="underline hover:text-blue-500">
            <router-link :to="'/contest/' + contestId + '/' + participant.user.id + '/result'" target="_blank">{{
                    participant.user.name
                }}
            </router-link>
        </td>
        <td>{{ participant.finished_problems }}</td>
        <td class="hover:text-blue-500">
            <router-link v-if="participant.user.profileUser" :to="'/View-User/'+participant.user.profileUser.id"
                         target="_blank">View
            </router-link>
        </td>
        <td>{{ participant.started_at }}</td>
    </tr>
</template>
<script>

export default {
    name: "Pariticipant",
    emits: ['click'],
    props: {
        contestId: 0,
        participant: {},
        finishedProblems: {
            default: 0
        }
    },
    methods: {
        click() {
            this.$emit('click', this.participant);
        }
    },
    mounted() {
    },
}
</script>
<style>

</style>
