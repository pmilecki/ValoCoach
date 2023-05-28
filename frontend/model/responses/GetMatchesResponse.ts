import { PlayerMatches } from '../PlayerMatches'

interface GetMatchesResponse {
  numOfRounds: Array<number>
  statsData: Array<PlayerMatches>
  damagePerRound: Array<number>
}

export type { GetMatchesResponse }
