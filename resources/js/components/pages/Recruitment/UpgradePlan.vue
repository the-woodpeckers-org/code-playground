<template>
  <div class="bg-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 sm:tracking-tight rainbow-text">
          Upgrade to Premium
        </h1>

        <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-5 sm:text-2xl">
          Enjoy <strong class="text-fuchsia-600 font-bold">CODE</strong> <strong
            class="text-gray-900 font-bold">PLAYGROUND</strong> to the fullest without any interruptions.
        </p>
      </div>

      <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <div
          class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 transform opacity-0 translate-y-10 transition-all duration-700 delay-[100ms]"
          data-scroll>
          <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900">Unlimited Jobs</h3>
            <p class="mt-2 text-base text-gray-500">
              Create as many jobs as you need without any limits.
            </p>
          </div>
          <div class="bg-gray-50 px-6 py-4">
            <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-300">
              Learn More
            </a>
          </div>
        </div>

        <div
          class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 transform opacity-0 translate-y-10 transition-all duration-700 delay-[200ms]"
          data-scroll>
          <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900">Priority Support</h3>
            <p class="mt-2 text-base text-gray-500">
              Get faster response times and personalized assistance.
            </p>
          </div>
          <div class="bg-gray-50 px-6 py-4">
            <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-300">
              Learn More
            </a>
          </div>
        </div>

        <div
          class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 transform opacity-0 translate-y-10 transition-all duration-700 delay-[300ms]"
          data-scroll>
          <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900">Advanced Analytics</h3>
            <p class="mt-2 text-base text-gray-500">
              Gain deeper insights into your project performance and usage.
            </p>
          </div>
          <div class="bg-gray-50 px-6 py-4">
            <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-colors duration-300">
              Learn More
            </a>
          </div>
        </div>
      </div>


      <div class="mt-16 flex justify-center">
        <router-link to="/checkout"
          class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
          Upgrade to Premium
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'UpgradePremium',
  mounted() {
    const elements = document.querySelectorAll("[data-scroll]");

    const observer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("opacity-100", "translate-y-0");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.3 }
    );

    elements.forEach((el) => observer.observe(el));
  }
};
</script>

<style scoped>
[data-scroll] {
  opacity: 0;
  transform: translateY(40px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}

.opacity-100 {
  opacity: 1;
  transform: translateY(0);
}

@keyframes rainbow {
  0% { color: red; }
  20% { color: orange; }
  100% { color: violet; }
}

.rainbow-text {
  animation: rainbow 5s infinite;
}

</style>