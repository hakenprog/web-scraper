import { getData } from "../../services/newsycombinatorService";

const originalFetch = global.fetch;

beforeEach(async () => {
    global.fetch = jest.fn(() => Promise.reject('Error on API'));
});

afterEach(() => {
    global.fetch = originalFetch;
});


describe('Test api promise rejected', () => {
    it('Return an empty array', async () => {
        const result = await getData(() => 'ok');
        expect(result).toStrictEqual([]);
    })
})