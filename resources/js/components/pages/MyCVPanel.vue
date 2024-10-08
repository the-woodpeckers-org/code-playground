<script>
import NavigatorCV from '@/components/navbar/NavigatorCV.vue';
export default {
  components: {
    NavigatorCV,
  },
}

</script>
<template>
  <div>
    <NavigatorCV pageActive="My CV"></NavigatorCV>
    <div class="mt-6 border-b"></div>
    <div class="flex lg:flex-row">
  <div class="grid flex-grow">content</div>
  <div class="divider lg:divider-horizontal"></div>
  <div class=" grid flex-grow">content</div>
  <div class=" grid flex-grow"><button>123</button></div>
  <div class=" grid flex-grow"><button>21</button></div>
  
</div>
  </div>
</template>

<style></style>