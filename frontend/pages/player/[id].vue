<template>
  <h3>Halo player</h3>

  <div v-for="(match, index) in matches.playerData" class="bg-tertiary history text-xl">
    <div>
      <img :src="match.assets.agent.small" style="width: 128px; height: 128px;">
    </div>

    <div class="stats">
      <div class="stat">
        <div>
          K/D/A
        </div>

        <div>
          {{ match.stats.kills }}/{{ match.stats.deaths }}/{{ match.stats.assists }}
        </div>
      </div>

      <div class="stat">
        <div>
          ACS
        </div>

        <div>
          {{ (parseInt(match.stats.score) / parseInt(matches.numOfRounds[index])).toFixed(0) }}
        </div>
      </div>

      <div class="stat">
        <div>
          ADR
        </div>

        <div>
          {{ (matches.damagePerRound[index]).toFixed(0) }}
        </div>
      </div>

      <div class="stat">
        <div>
          HS%
        </div>

        <div>
          {{ ((match.stats.headshots / (match.stats.headshots + match.stats.bodyshots + match.stats.legshots))*100).toFixed(0) }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()
// When accessing /posts/1, route.params.id will be 1
// console.log(route.params.id)

const { data: matches, error } = await useAsyncData('matches', () => $fetch('http://localhost/valo'))

console.log(matches)
</script>

<style>
.history {
  margin: 8px 0px;
  padding: 8px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
}

.stats {
  display: flex;
  flex-direction: row;
}
.stat {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-left: 16px;
}
</style>
