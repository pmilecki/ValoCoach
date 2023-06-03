<template>
  <div class="text-7xl">
    <a class="text-[#263747]">{{ match.scoreBlue.rounds_won }}</a>

    - <a class="text-secondaryRed">{{ match.scoreRed.rounds_won }}</a>
  </div>

  <div class="flex min-w-max max-w-screen-2xl flex-col text-xl">
    <div>
      <div class="mt-4">
        <div class="grid grid-cols-10 items-center p-2">
          <div />

          <div />

          <div>
            ACS
          </div>

          <div>
            ADR
          </div>

          <div>
            K
          </div>

          <div>
            D
          </div>

          <div>
            A
          </div>

          <div>
            +/-
          </div>

          <div>
            K/D
          </div>

          <div>
            HS%
          </div>
        </div>

        <div v-for="(playerBlue, no) in match.matchInfo.blue"
             :key="no">
          <div class="text-milk mt-2 grid grid-cols-10 items-center bg-[#263747] p-2">
            <div class="col-span-2 flex flex-row items-center gap-6"                
                 style="height: 64px; width: auto; overflow: hidden; position: relative;">
              <img :src="`${playerBlue.assets.card.wide}`" style="position: absolute; opacity: 0.5;">

              <figure>
                <img :src="playerBlue.assets.agent.small" style="width: 64px; height: 64px; object-fit: cover; position: relative;">
              </figure>

              <div style="position: relative;">
                {{ playerBlue.name }}#{{ playerBlue.tag }}
              </div>
            </div>

            <div>
              {{ (playerBlue.stats.score / match.numOfRounds).toFixed(0) }}
            </div>

            <div>
              {{ (playerBlue.damage_made / match.numOfRounds).toFixed(0) }}
            </div>

            <div>
              {{ playerBlue.stats.kills }}
            </div>

            <div>
              {{ playerBlue.stats.deaths }}
            </div>

            <div>
              {{ playerBlue.stats.assists }}
            </div>

            <div>
              {{ playerBlue.stats.kills - playerBlue.stats.deaths > 0 ? "+": "" }}{{ playerBlue.stats.kills - playerBlue.stats.deaths }}
            </div>

            <div>
              {{ (playerBlue.stats.kills / playerBlue.stats.deaths).toFixed(1) }}
            </div>

            <div>
              {{ ((playerBlue.stats.headshots / (playerBlue.stats.headshots + playerBlue.stats.bodyshots + playerBlue.stats.legshots))*100).toFixed(1) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4">
      <div class="grid grid-cols-10 items-center p-2">
        <div />

        <div />

        <div>
          ACS
        </div>

        <div>
          ADR
        </div>

        <div>
          K
        </div>

        <div>
          D
        </div>

        <div>
          A
        </div>

        <div>
          +/-
        </div>

        <div>
          K/D
        </div>

        <div>
          HS%
        </div>
      </div>

      <div v-for="(playerRed, no) in match.matchInfo.red" :key="no">
        <div class="bg-secondaryRed mt-2 grid grid-cols-10 items-center p-2">
          <div class="col-span-2 flex flex-row items-center gap-6"                
               style="height: 64px; width: auto; overflow: hidden; position: relative;">
            <img :src="`${playerRed.assets.card.wide}`" style="position: absolute; opacity: 0.5;">

            <figure>
              <img :src="playerRed.assets.agent.small" style="width: 64px; height: 64px; object-fit: cover; position: relative;">
            </figure>

            <div style="position: relative;">
              {{ playerRed.name }}#{{ playerRed.tag }}
            </div>
          </div>

          <div>
            {{ (playerRed.stats.score / match.numOfRounds).toFixed(0) }}
          </div>

          <div>
            {{ (playerRed.damage_made / match.numOfRounds).toFixed(0) }}
          </div>

          <div>
            {{ playerRed.stats.kills }}
          </div>

          <div>
            {{ playerRed.stats.deaths }}
          </div>

          <div>
            {{ playerRed.stats.assists }}
          </div>

          <div>
            {{ playerRed.stats.kills - playerRed.stats.deaths > 0 ? "+": "" }}{{ playerRed.stats.kills - playerRed.stats.deaths }}
          </div>

          <div>
            {{ (playerRed.stats.kills / playerRed.stats.deaths).toFixed(1) }}
          </div>

          <div>
            {{ ((playerRed.stats.headshots / (playerRed.stats.headshots + playerRed.stats.bodyshots + playerRed.stats.legshots))*100).toFixed(1) }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { GetMatchResponse } from '~/model/responses/GetMatchResponse'

const route = useRoute()
// When accessing /posts/1, route.params.id will be 1
// console.log(route.params.id)

const { data } = await useAsyncData<GetMatchResponse>('match', () =>
  $fetch(`http://localhost/api/v1/valorant/match/${route.params.matchId}`)
)

const match = computed((): GetMatchResponse => {
  return (
    data.value ?? {
      matchInfo: Object(),
      numOfRounds: 0,
      scoreRed: Object(),
      scoreBlue: Object(),
    }
  )
})
</script>
