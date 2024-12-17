<template>
    <tr class="h-auto">
        <td>{{ formattedTime }}</td>
        <td> <a :href="`/View-User/${profile_user_id}`" target="_blank">{{ name }}</a></td>
        <td><a :href="linkCV" target="_blank">View CV</a></td>
        <td>{{ status }}</td>
        <td @click="toggleOptions">
            <i class="fa-solid fa-ellipsis-vertical hover:text-red-500"></i>
        </td>
      
    </tr>
        <tr v-if="showOptions" class="bg-gray-50">
        <td colspan="5">
            <ul class="text-sm">
                <li v-if="status !=='rejected' " @click="refuseCV" class="px-4 py-2 hover:bg-red-100 cursor-pointer">Rejected</li>
                <li v-if="status !=='approved'" @click="approveCV" class="px-4 py-2 hover:bg-green-100 cursor-pointer">Approved</li>
            </ul>
        </td>
    </tr>
</template>
<script>
export default {
    name: "CvItemApplied",
    emits: ['refuseCV'],
    emits: ['approveCV'],
    data() {
        return {
            showOptions: false
        }
    },
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
        profile_user_id: {
            type: String,
            default: 0
        },
        linkCV: {
            type: String,
            default: 'N/A'
        },
        status: {
            type: String,
            default: 'N/A'
        }
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
        refuseCV() {
            this.$emit('refuseCV', this.id_cv);
            this.showOptions = false;
        },
        toggleOptions() {
            this.showOptions = !this.showOptions;
        },
       approveCV() {
            this.showOptions = false;
            this.$emit('approveCV', this.id_cv);
        },
    }
}
</script>