interface Stats {
  score: number
  kills: number
  deaths: number
  assists: number
  bodyshots: number
  headshots: number
  legshots: number
}

interface Red {
  name: string
  tag: string
  stats: Stats
}

interface Blue {
  name: string
  tag: string
  stats: Stats
}

interface Match {
  red: Array<Red>
  blue: Array<Blue>
}

export type { Match }
