var config = {
        container: "#basic-example",
        
        connectors: {
            type: 'step'
        },
        node: {
            HTMLclass: 'nodeExample1',
            scrollbar : "None" 
        },
    },
    bos = {
        text: {
            name: "Mark Hill",
            title: "Chief executive officer",
            contact: "Tel: 01 213 123 134",
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png",
        link: {
            href: "#"
        },
    },

    cto = {
        parent: bos,
        text:{
            name: "Joe Linux",
            title: "Chief Technology Officer",
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    },
    cbo = {
        parent: bos,
        text:{
            name: "Linda May",
            title: "Chief Business Officer",
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    },
    cdo = {
        parent: bos,
        text:{
            name: "John Green",
            title: "Chief accounting officer",
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    },
    cio = {
        parent: cto,
        text:{
            name: "Ron Blomquist",
            title: "Chief Information Security Officer"
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    },
    ciso = {
        parent: cto,
        text:{
            name: "Michael Rubin",
            title: "Chief Innovation Officer",
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    },
    cio2 = {
        parent: cdo,
        text:{
            name: "Erica Reel",
            title: "Chief Customer Officer"
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    },
    ciso2 = {
        parent: cbo,
        text:{
            name: "Alice Lopez",
            title: "Chief Communications Officer"
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    },
    ciso3 = {
        parent: cbo,
        text:{
            name: "Mary Johnson",
            title: "Chief Brand Officer"
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    },
    ciso4 = {
        parent: cbo,
        text:{
            name: "Kirk Douglas",
            title: "Chief Business Development Officer"
        },
        link: {
            href: "#"
        },
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
    }

    chart_config = [
        config,
        bos,
        cto,
        cbo,
        cdo,
        cio,
        ciso,
        cio2,
        ciso2,
        ciso3,
        ciso4
    ];




    // Another approach, same result
    // JSON approach

/*
    var chart_config = {
        chart: {
            container: "#basic-example",
            
            connectors: {
                type: 'step'
            },
            node: {
                HTMLclass: 'nodeExample1'
            }
        },
        nodeStructure: {
            text: {
                name: "Mark Hill",
                title: "Chief executive officer",
                contact: "Tel: 01 213 123 134",
            },
            image: "../headshots/2.jpg",
            children: [
                {
                    text:{
                        name: "Joe Linux",
                        title: "Chief Technology Officer",
                    },
                    stackChildren: true,
                    image: "../headshots/1.jpg",
                    children: [
                        {
                            text:{
                                name: "Ron Blomquist",
                                title: "Chief Information Security Officer"
                            },
                            image: "../headshots/8.jpg"
                        },
                        {
                            text:{
                                name: "Michael Rubin",
                                title: "Chief Innovation Officer",
                                contact: "we@aregreat.com"
                            },
                            image: "../headshots/9.jpg"
                        }
                    ]
                },
                {
                    stackChildren: true,
                    text:{
                        name: "Linda May",
                        title: "Chief Business Officer",
                    },
                    image: "../headshots/5.jpg",
                    children: [
                        {
                            text:{
                                name: "Alice Lopez",
                                title: "Chief Communications Officer"
                            },
                            image: "../headshots/7.jpg"
                        },
                        {
                            text:{
                                name: "Mary Johnson",
                                title: "Chief Brand Officer"
                            },
                            image: "../headshots/4.jpg"
                        },
                        {
                            text:{
                                name: "Kirk Douglas",
                                title: "Chief Business Development Officer"
                            },
                            image: "../headshots/11.jpg"
                        }
                    ]
                },
                {
                    text:{
                        name: "John Green",
                        title: "Chief accounting officer",
                        contact: "Tel: 01 213 123 134",
                    },
                    image: "../headshots/6.jpg",
                    children: [
                        {
                            text:{
                                name: "Erica Reel",
                                title: "Chief Customer Officer"
                            },
                            link: {
                                href: "http://www.google.com"
                            },
                            image: "../headshots/10.jpg"
                        }
                    ]
                }
            ]
        }
    };

*/