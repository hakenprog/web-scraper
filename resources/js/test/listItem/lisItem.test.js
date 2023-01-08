/**resources/js/test/index.test.js**/
import React from 'react';
import { render, screen } from '@testing-library/react';
import ListItem from '../Components/listItem/ListItem'

describe('Validate List Item component', () => {

    describe('Validate display the correct Information', () => {
        const item = {
            title: 'This is a title',
            rank: 1,
            comments: 50,
            points: 3
        }

        it('It should render and show the correct information', () => {
            render(<ListItem item={item} />)
            expect(screen.getAllByText(item.title)).toBeDefined()
            expect(screen.getAllByText(item.rank)).toBeDefined()
            expect(screen.getAllByText('Comments: 50 Points: 3')).toBeDefined()
        })

        it('It should not exists an incorrect title', () => {
            const { container } = render(<ListItem item={item} />)
            const title = container.querySelector('h3')
            expect(title.textContent).not.toBe('to not be this title')
        })
    })

    describe('Validate it renders correctly with invalid values.'), () => {
        it('It should render with null values', () => {
            const item = {
                title: 'This is a title',
                rank: null,
                comments: null,
                points: 3
            }
            render(<ListItem item={item} />)
        })

        it('It should render with a non existent item', () => {
            const item = {
                title: 'This is a title',
                points: 3
            }
            render(<ListItem item={item} />)
        })
    }


})