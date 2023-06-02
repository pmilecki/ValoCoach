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
  name: string
  tag: string
  stats: Stats
  assets: Assets
}

interface Match {
  red: Array<Player>
  blue: Array<Player>
}

export type { Match }
