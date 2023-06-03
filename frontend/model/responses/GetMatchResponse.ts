import { Match } from '../Match'
import { TeamScore } from '../TeamScore'

interface GetMatchResponse {
  matchInfo: Match
  numOfRounds: number
  scoreRed: TeamScore
  scoreBlue: TeamScore
}

export type { GetMatchResponse }
