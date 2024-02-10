import { SnapshotStateOptions } from "vitest"

// interface MatchScore {
//   rounds_won: number
//   rounds_lost: number
//   has_won: boolean
// }

interface Card {
  small: string
  large: string
  wide: string
}

interface Agent {
  small: string
  bust: string
  full: string
  killfeed: string
}

interface Assets {
  card: Card
  agent: Agent
}

interface Character {
  id: string
  name: string
}

interface Stats {
  score: number
  kills: number
  deaths: number
  assists: number
}

interface Damage {
  made: number
  received: number
}

interface Shots {
  head: number
  body: number
  leg: number
}

interface PlayerData {
  puuid: string
  team: string
  character: Character
  tier: string
  shots: Shots
  damage: Damage
}

interface PlayerMatches {
  matchId: string
  playerData: PlayerData
  stats: Stats
  playerRoundsWon: number
  playerRoundsLost: number
  tier: string
}

export type { PlayerMatches }
