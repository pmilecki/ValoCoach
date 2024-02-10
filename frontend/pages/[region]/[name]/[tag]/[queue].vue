<template>
  <h3 style="padding-bottom: 16px; font-weight: bold;">
    {{ route.params.name }}#{{ route.params.tag }}
  </h3>

  <div class="w-8/12">
    <div v-for="(match, index) in matches.statsData" :key="index" class="bg-tertiaryRed hover:bg-primaryRed ml-2 p-2 text-xl transition duration-150 ease-in-out hover:scale-110" :class="{ won: match.playerRoundsWon > match.playerRoundsLost, lost: match.playerRoundsWon < match.playerRoundsLost }">
      <nuxt-link :to="`/match/${match.playerData.puuid}/${match.matchId}`">
        <div class="flex flex-row flex-wrap items-center justify-between">
          <figure>
            <img :src="`https://media.valorant-api.com/agents/${match.playerData.character.id}/displayicon.png`" style="width: 128px; height: 128px;">
          </figure>

          <div>
            {{ match.playerRoundsWon }} - {{ match.playerRoundsLost }}
          </div>

          <div>
            {{ match.tier }}
          </div>

          <div class="flex">
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
                {{ (match.stats.score / matches.numOfRounds[index]).toFixed(0) }}
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
                {{ ((match.playerData.shots.head / (match.playerData.shots.head + match.playerData.shots.body + match.playerData.shots.leg))*100).toFixed(1) }}
              </div>
            </div>
          </div>
        </div>
      </nuxt-link>
    </div>
  </div>
</template>

<script setup lang="ts">
import { GetMatchesResponse } from '~/model/responses/GetMatchesResponse'

const route = useRoute()
// When accessing /posts/1, route.params.id will be 1
// console.log(route.params.id)

const { data } = await useAsyncData<GetMatchesResponse>('matches', () =>
  $fetch(
    `http://localhost/api/v2/valorant/match-history/${route.params.region}/${route.params.name}/${route.params.tag}/${route.params.queue}`
  )
)

const matches = computed((): GetMatchesResponse => {
  return (
    data.value ?? {
      numOfRounds: [],
      statsData: [],
      damagePerRound: [],
      playerInfo: ""
    }
  )
})
</script>

<style>
.won {
  border-left: 6px solid green;
}

.lost {
  border-left: 6px solid red;
}

.stat {
  display: flex;
  flex-direction: column;
  margin: 8px;
}
</style>
