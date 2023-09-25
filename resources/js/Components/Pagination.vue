<template>
  <div class="flex justify-between">
    <div>
      <Component
        :is="link.url ? 'Link' : 'span'"
        v-for="link in links"
        v-bind:key="link.label"
        :href="link.url"
        v-html="link.label"
        class="text-black px-1"
        :class="{ 'text-gray-500': !link.url, 'font-bold': link.active }"
      />
    </div>
    <select @change="$emit('limitEvent',limit)" v-model="limit" class="rounded-lg">
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="20">20</option>
      <option value="30">30</option>
      <option value="40">40</option>
      <option value="50">50</option>
    </select>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  props: {
    links: Array,
  },
  components: {
    Link,
  },
  data(){
    return{
      limit:'',
    }
  }
};
</script>