interface Stats {
  score: number
  kills: number
  deaths: number
  assists: number
  bodyshots: number
  headshots: number
  legshots: number
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

interface Player {
  puuid: string
  name: string
  tag: string
  stats: Stats
  assets: Assets
  damage_made: number
  damage_received: number
}

interface Match {
  red: Array<Player>
  blue: Array<Player>
  numOfRounds: number
}

export type { Match }
