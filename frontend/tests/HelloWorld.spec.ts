import { describe, it, expect } from 'vitest'
import { mount } from '@vue/test-utils'

import Content from '../components/Content.vue'

describe('Content', () => {
  it('is a Vue instance', () => {
    const wrapper = mount(Content)
    expect(wrapper.vm).toBeTruthy()
  })
})