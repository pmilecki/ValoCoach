import { Match } from '../Match'

interface GetMatchesResponse {
  numOfRounds: Array<number>
  statsData: Array<Match>
  damagePerRound: Array<number>
}

export type { GetMatchesResponse }
