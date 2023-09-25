<template>
    <div class="absolute flex flex-col top-20 right-5 space-y-5 z-20">
        <div v-if="messages">
            <notification-item v-for="message in messages" v-bind:key="message" :notification="message"></notification-item>
        </div>
    </div>
</template>

<script>
import NotificationItem from '@/Components/NotificationItem'
export default {
    setup() {
        
    },
    props:{
        notification: Object,
        messages: Object,
    },
    components:{
        NotificationItem
    }
}
</script>