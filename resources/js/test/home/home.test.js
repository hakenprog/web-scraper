import React from 'react';
import { fireEvent, render, screen } from '@testing-library/react';

import Home from '../../Pages/home/Home';
import { act, Simulate } from 'react-dom/test-utils';
import homeDataset from './dataset';

const originalFetch = global.fetch;
const originalContainer = global.container;

beforeEach(async () => {
    global.fetch = jest.fn(() => Promise.resolve({
        json: () => Promise.resolve(
            homeDataset
        )
    }));
    const { container } = await act(async () => render(<Home />));
    global.container = container;
});

afterEach(() => {
    global.fetch = originalFetch;
    global.container = originalContainer;
});

const extractNumber = (text) => parseInt(text.innerHTML.split(' ')[1])
const clickInputFilter = (name) => {
    const radio = container.querySelector(`input[name="${name}"]`);
    fireEvent.click(radio);
}
const validateOrder = (variable, validationCallback) => {
    [...container.querySelectorAll(`.${variable}`)].reduce(
        (prev, current) => {
            validationCallback(extractNumber(prev), extractNumber(current));
            return current
        }
    )
}

describe('Validate Home component', () => {

    describe('Validate display the correct Information', () => {
        it('It should render and show the correct information', async () => {
            expect(screen.getAllByText("Production Twitter on one machine? 100Gbps NICs and NVMe are fast")).toBeDefined();
            expect(screen.getAllByText("Tilck – A Tiny")).toBeDefined();
            expect(screen.getAllByText("Jailbroken iOS can't run macOS apps – I spent a week to find out why (2021)")).toBeDefined();
        })

    })
    describe('Test Input Filter More than Five Words In Title behavior', () => {

        it('Validate title word length filter', async () => {

            clickInputFilter("moreThanFive");
            container.querySelectorAll('.title').forEach(
                title => expect(title.innerHTML.split(' ').length).toBeGreaterThan(5)
            )
        });

        it('Validate ordered by comments in ascending order', async () => {

            clickInputFilter("moreThanFive");
            validateOrder('comments', (prev, current) => expect(current).toBeGreaterThanOrEqual(prev))
        });

        it('Validate ordered by comments in descending order', async () => {

            clickInputFilter("moreThanFive");
            act(() => {
                Simulate.change(container.querySelector('select'), { target: { value: "descending" } });
            });
            validateOrder('comments', (prev, current) => expect(current).toBeLessThanOrEqual(prev))
        });

    })

    describe('Test Input Filter Less than or equal Five Words In Title behavior', () => {

        it('Validate title word length filter', async () => {

            clickInputFilter("lessThanFive");
            container.querySelectorAll('.title').forEach(
                title => expect(title.innerHTML.split(' ').length).toBeLessThanOrEqual(5)
            )
        });

        it('Validate ordered by points in ascending order', async () => {

            clickInputFilter("lessThanFive");
            validateOrder('points', (prev, current) => expect(current).toBeGreaterThanOrEqual(prev))

        });

        it('Validate ordered by points in descending order', async () => {
            clickInputFilter("lessThanFive");
            act(() => {
                Simulate.change(container.querySelector('select'), { target: { value: "descending" } });
            });
            validateOrder('points', (prev, current) => expect(current).toBeLessThanOrEqual(prev));
        });
    })
})