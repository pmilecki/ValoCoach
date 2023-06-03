import { test, expect } from 'vitest'

const BAD_TEST_URL = 'http://localhost/api/v1/valorant/match-history/eu/Banzai/ROSE/competitive'
const GOOD_TEST_URL = 'http://localhost/api/v1/valorant/match-history/eu/Banzaii/ROSE/competitive'

test('JSON with status 200', async () => {
    const data = await fetch(GOOD_TEST_URL)
    expect(data.status).toBe(200)
})

test('JSON with status 404', async () => {
    const data = await fetch(BAD_TEST_URL)
    expect(data.status).toBe(404)
})

test('Service is a teapot', async () => {
    const data = await fetch('http://localhost/api/teapot')
    expect(data.ok).eq(false)
    expect(data.status).toBe(418)
})