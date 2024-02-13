<template>
    <div v-for="(tip, no) in tipsResponse" :key="no" class="">
        <div class="text-xl bg-tertiaryRed m-2 p-2">{{ tip }}</div>
    </div>
</template>

<script setup lang="ts">

const route = useRoute()

const { data } = await useAsyncData<Array<string>>('tips', () =>
  $fetch(`http://localhost/api/v2/valorant/stats/${route.params.matchId}/${route.params.playerId}`)
)

const tipsResponse = computed((): Array<string> => {
  return (
    data.value ?? []
  )
})

</script>