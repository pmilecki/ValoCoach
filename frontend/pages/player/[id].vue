<template>
  <h3>Halo player</h3>
  <div>
    <!-- {{ key }}: {{ item}} -->
    {{ matches.data[0].players.all_players[1].name }}#{{ matches.data[0].players.all_players[1].tag }}
    {{ matches.data[0].players.all_players[1].currenttier_patched }}
    <div>
      {{ matches.data[0].players.all_players[1].stats.kills }}/{{ matches.data[0].players.all_players[1].stats.deaths }}/{{ matches.data[0].players.all_players[1].stats.assists }}
      <img :src="matches.data[0].players.all_players[1].assets.agent.small" />
    </div>
    <br />
    <!-- {{ matches.data[0].players.all_players[1] }} -->
    
  </div>
</template>

<script setup lang="ts">
const route = useRoute()
// When accessing /posts/1, route.params.id will be 1
console.log(route.params.id)

const { data: matches, error } = await useAsyncData(
  'matches',
  () => $fetch('https://api.henrikdev.xyz/valorant/v3/matches/eu/Banzaii/Rose?filter=competitive')
  // () => $fetch('https://api.henrikdev.xyz/valorant/v1/leaderboard/eu')
)

//console.log(matches.value.data[0].players.all_players[1].stats)
//console.log(error)
</script>
