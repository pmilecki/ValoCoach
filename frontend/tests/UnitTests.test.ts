import { expect, test, it } from "vitest";
import { mount } from "@vue/test-utils";

import Footer from '../components/Footer.vue'
import PlayerSearch from "../components/PlayerSearch.vue";

test('is footer visible', async () => {
    const wrapper = mount(Footer);
    expect(wrapper.isVisible()).toBe(true);
})

test('is content of footer equal to @pmilecki', async () => {
    expect(Footer).toBeTruthy();

    const wrapper = mount(Footer);
    expect(wrapper.find('a').text()).toContain("@pmilecki");  
})

test('verify nick field in PlayerSearch', async () => {
    const wrapper = mount(PlayerSearch);
    const nickField = wrapper.find('#nick');
    
    expect(nickField.html()).toBe(`<input id="nick" name="nick" type="text" placeholder="Nickname" class="bg-primaryRed rounded-md p-1" required="">`);
})

test('verify if PlayerSearchComponent exists', async () => {
    const wrapper = mount(PlayerSearch);
    const searchForm = wrapper.find('.userSearch');
    expect(searchForm.find('#nick').exists()).toBe(true);
    expect(searchForm.find('#tag').exists()).toBe(true);
    expect(searchForm.find('#server').exists()).toBe(true);
    expect(searchForm.find('#queueType').exists()).toBe(true);
})

test('input data to fields in form', async () => {
    const wrapper = mount(PlayerSearch);

    const searchForm = wrapper.find('form');

    const nick = searchForm.find('#nick')
    const tag = searchForm.find('#tag')
    const server = searchForm.find('#server')
    const queue = searchForm.find('#queueType')

    await nick.setValue("Banzaii")
    await tag.setValue('ROSE')
    await server.setValue('eu')
    await queue.setValue('competitive')

    expect((nick.element as HTMLInputElement).value).toBe('Banzaii')
    expect((tag.element as HTMLInputElement).value).toBe('ROSE')
    expect((server.element as HTMLSelectElement).value).toBe('eu')
    expect((queue.element as HTMLSelectElement).value).toBe('competitive')
})