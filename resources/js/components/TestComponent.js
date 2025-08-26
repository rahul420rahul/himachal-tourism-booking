import React from 'react';

const TestComponent = () => {
    return React.createElement('div', { className: 'p-8 bg-blue-100 rounded-lg' },
        React.createElement('h2', { className: 'text-2xl font-bold mb-4' }, 'React is Working!'),
        React.createElement('p', {}, 'If you can see this, React setup is successful.')
    );
};

export default TestComponent;
