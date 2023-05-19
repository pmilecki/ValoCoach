interface MatchScore {
  rounds_won: number
  rounds_lost: number
  has_won: boolean
}

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

interface Stats {
  score: number
  kills: number
  deaths: number
  assists: number
  bodyshots: number
  headshots: number
  legshots: number
}

interface PlayerData {
  assets: Assets
  name: string
  team: string
  currenttier_patched: string
  stats: Stats
}

interface Match {
  score: MatchScore
  playerData: PlayerData
  matchId: string
}

export type { Match }
