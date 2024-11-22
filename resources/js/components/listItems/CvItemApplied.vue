<template>
    <tr class="h-auto">
        <td>{{ formattedTime }}</td>
        <td> <a :href="`/View-User/${id_user}`" target="_blank">{{ name }}</a></td>
        <td><a :href="linkCV" target="_blank">{{ linkCV }}</a></td>
        <td>{{ status }}</td>
        
        <!-- Clickable icon to toggle options -->
        <td @click="toggleOptions">
            <i class="fa-solid fa-ellipsis-vertical hover:text-red-500"></i>
          
        </td>
      
    </tr>
    <div v-if="showOptions" class="absolute bg-white border rounded shadow-lg right-0 top-0">
                <ul class="text-sm">
                    <li @click="refuseCV" class="px-4 py-2 hover:bg-red-100 cursor-pointer">Từ chối</li>
                    <li @click="capproveCV" class="px-4 py-2 hover:bg-green-100 cursor-pointer">Duyệt</li>
                </ul>
        </div>
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
        id_user: {
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
       capproveCV() {
            // Handle approve logic here
            this.showOptions = false;
            this.$emit('approveCV', this.id_cv);
        },
    }
}
</script>