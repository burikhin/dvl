import { shallow, mount } from 'vue-test-utils';
import expect from 'expect';
import TodoList from '../../resources/assets/js/components/TodoList.vue';
import moxios from 'moxios'

describe('TodoList', () => {
    beforeEach(() => {
        moxios.install(axios);
    });

    afterEach(() => {
        moxios.uninstall(axios);
    });

    it('renders the correct title on the page', () => {
        let wrapper = shallow(TodoList);

        expect(wrapper.html()).toContain('Todo List');
    });

    it('shows the todos fetched from the api', (done) => {
        let wrapper = mount(TodoList);

        moxios.stubRequest('/api/todo', {
            status: 200,
            response: [
                {
                    id: 1,
                    text: "Bingo",
                    finished: false,
                    created_at: "2018-01-10 00:00:00",
                    updated_at: "2018-01-10 00:00:00",
                }
            ],
        });

        moxios.wait(() => {
            expect(wrapper.html()).toContain('Bingo');
            done();
        });
    })
});