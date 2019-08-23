


Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'pages',
            path: '/pages',
            component: require('./components/Tool'),
            props: {resourceName: 'pages'}
        },
    ])
})
