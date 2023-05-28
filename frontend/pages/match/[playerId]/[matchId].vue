<template>
  <!-- {{ match.matchInfo }} -->
  <div class="flex w-4/5 flex-col text-xl">
    <div>
      <div class="mt-4">
        <div class="grid grid-cols-8 justify-items-center">
          <div>
            Name
          </div>

          <div>
            ACS
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

        <div v-for="(playerBlue, no) in match.matchInfo.blue" :key="no">
          <div class="bg-blue grid grid-cols-8 justify-items-center p-2 text-black">
            <div>
              {{ playerBlue.name }}#{{ playerBlue.tag }} 
            </div>

            <div>
              {{ (playerBlue.stats.score / match.numOfRounds).toFixed(0) }}
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
      <div class="grid grid-cols-8 justify-items-center">
        <div>
          Name
        </div>

        <div>
          ACS
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
        <div class="bg-red grid grid-cols-8 justify-items-center p-2 text-black">
          <div>
            {{ playerRed.name }}#{{ playerRed.tag }} 
          </div>

          <div>
            {{ (playerRed.stats.score / match.numOfRounds).toFixed(0) }}
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
  $fetch('http://localhost/valoMatch/' + route.params.matchId)
)

const match = computed((): GetMatchResponse => {
  return (
    data.value ?? {
      matchInfo: Object(),
      numOfRounds: 0,
    }
  )
})
</script>
