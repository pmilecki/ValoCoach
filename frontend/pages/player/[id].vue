<template>
  <h3>Halo player</h3>

  <div class="flex flex-col flex-wrap content-center">
    <div v-for="(match, index) in matches.statsData" :id="match.matchId" class="bg-tertiary history hover:bg-primary w-8/12 max-w-7xl text-xl transition duration-150 ease-in-out hover:scale-110" :class="{ won: match.score.has_won, lost: !match.score.has_won }">
      <div>
        <img :src="match.playerData.assets.agent.small" style="width: 128px; height: 128px;">
      </div>

      <div>
        {{ match.score.rounds_won }} - {{ match.score.rounds_lost }}
      </div>

      <div>
        {{ match.playerData.currenttier_patched }}
      </div>

      <div class="stats">
        <div class="stat">
          <div>
            K/D/A
          </div>

          <div>
            {{ match.playerData.stats.kills }}/{{ match.playerData.stats.deaths }}/{{ match.playerData.stats.assists }}
          </div>
        </div>

        <div class="stat">
          <div>
            ACS
          </div>

          <div>
            {{ (parseInt(match.playerData.stats.score) / parseInt(matches.numOfRounds[index])).toFixed(0) }}
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
            {{ ((match.playerData.stats.headshots / (match.playerData.stats.headshots + match.playerData.stats.bodyshots + match.playerData.stats.legshots))*100).toFixed(0) }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
// const route = useRoute()
// When accessing /posts/1, route.params.id will be 1
// console.log(route.params.id)

const { data: matches } = await useAsyncData('matches', () => $fetch('http://localhost/valo'))
</script>

<style>
.won {
  border-left: 6px solid green;
}

.lost {
  border-left: 6px solid red;
}

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
