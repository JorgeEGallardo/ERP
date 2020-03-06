<style>
    body {
        background-color: #ffffff;
    }

    svg {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -250px;
        margin-left: -400px;
    }

    .message-box {
        height: 200px;
        width: 380px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -100px;
        margin-left: 50px;
        color: #FFF;
        font-family: Roboto;
        font-weight: 300;
    }

    .message-box h1 {
        font-size: 60px;
        line-height: 46px;
        margin-bottom: 40px;
    }

    @import url("https://fonts.googleapis.com/css?family=Montserrat:600&display=swap");

    body {
        height: 100vh;
        margin: 0;
        display: grid;
        place-items: center;
    }

    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    .multi-button {
        margin-left: -0.5rem;
        margin-right: -0.5rem;
    }

    .multi-button button {
        background: white;
        border: 0.125em solid black;
        cursor: pointer;
        font: 600 1.5rem/1.25 "Montserrat", sans-serif;
        letter-spacing: 0.125em;
        margin: 0.5rem;
        padding: 0.5em 0.75em;
        position: relative;
        text-transform: uppercase;
    }

    .multi-button button:before,
    .multi-button button:after {
        content: "";
        position: absolute;
        transition: all 0.125s ease-in-out;
    }

    .multi-button button.cut {
        background: none;
        border-color: transparent;
    }

    .multi-button button.cut:before,
    .multi-button button.cut:after {
        transition: all 0.175s ease-in-out;
    }

    .multi-button button.cut:before {
        background: black;
        border: 0px dashed black;
        left: -0.125em;
        top: -0.125em;
        right: -0.125em;
        bottom: -0.125em;
        z-index: -1;
    }

    .multi-button button.cut:hover:before,
    .multi-button button.cut:focus:before {
        background: white;
        border-width: 0.125em;
    }

    .multi-button button.cut:after {
        background: white;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: -1;
    }

    .multi-button button.copy:after {
        border: 0.125em dashed black;
        bottom: -0.125em;
        left: -0.125em;
        right: -0.125em;
        top: -0.125em;
        z-index: -1;
    }

    .multi-button button.copy:hover:after,
    .multi-button button.copy:focus:after {
        bottom: -0.375em;
        left: 0.125em;
        right: -0.375em;
        top: 0.125em;
    }

    .multi-button button.paste:after {
        border: 0.125em dashed black;
        bottom: -0.125em;
        left: -0.125em;
        right: -0.125em;
        top: -0.125em;
    }

    .multi-button button.paste:hover:after,
    .multi-button button.paste:focus:after {
        bottom: 0.125em;
        left: 0.125em;
        right: 0.125em;
        top: 0.125em;
    }


    #Polygon-1,
    #Polygon-2,
    #Polygon-3,
    #Polygon-4,
    #Polygon-4,
    #Polygon-5 {
        animation: float 1s infinite ease-in-out alternate;
    }

    #Polygon-2 {
        animation-delay: .2s;
    }

    #Polygon-3 {
        animation-delay: .4s;
    }

    #Polygon-4 {
        animation-delay: .6s;
    }

    #Polygon-5 {
        animation-delay: .8s;
    }

    @keyframes float {
        100% {
            transform: translateY(20px);
        }
    }

    @media (max-width: 450px) {
        svg {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -250px;
            margin-left: -190px;
        }

        .message-box {
            top: 50%;
            left: 50%;
            margin-top: -100px;
            margin-left: -190px;
            text-align: center;
        }
    }
    .btn {
    z-index: 1;
    overflow: hidden;
    background: transparent;
    position: relative;
    padding: 8px 50px;
    border-radius: 30px;
    cursor: pointer;
    font-size: 1em;
    letter-spacing: 2px;
    -webkit-transition: 0.2s ease;
    transition: 0.2s ease;
    font-weight: bold;
    margin: 5px 0px;
}
.btn:focus, .btn:hover {
    text-decoration: none;
}
.btn.green {
    border: 4px solid #2ccf6d;
    color: #0e0620;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.btn.green:hover {
    color: #ffffff;
    background: #2ccf6d;
    -webkit-transition: 0.2s ease;
    transition: 0.2s ease;
}
</style>
<svg width="380px" height="500px" viewBox="0 0 837 1045" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
        <path d="M353,9 L626.664028,170 L626.664028,487 L353,642 L79.3359724,487 L79.3359724,170 L353,9 Z" id="Polygon-1" stroke="#007FB2" stroke-width="6" sketch:type="MSShapeGroup"></path>
        <path d="M78.5,529 L147,569.186414 L147,648.311216 L78.5,687 L10,648.311216 L10,569.186414 L78.5,529 Z" id="Polygon-2" stroke="#EF4A5B" stroke-width="7" sketch:type="MSShapeGroup"></path>
        <path d="M773,186 L827,217.538705 L827,279.636651 L773,310 L719,279.636651 L719,217.538705 L773,186 Z" id="Polygon-3" stroke="#795D9C" stroke-width="6" sketch:type="MSShapeGroup"></path>
        <path d="M639,529 L773,607.846761 L773,763.091627 L639,839 L505,763.091627 L505,607.846761 L639,529 Z" id="Polygon-4" stroke="#F2773F" stroke-width="6" sketch:type="MSShapeGroup"></path>
        <path d="M281,801 L383,861.025276 L383,979.21169 L281,1037 L179,979.21169 L179,861.025276 L281,801 Z" id="Polygon-5" stroke="#36B455" stroke-width="6" sketch:type="MSShapeGroup"></path>
    </g>
</svg>
<div style="width:30%;float:right;margin-left:50%;">
    <h1 style="font-size:7.5rem;font-weight:bold;margin:1rem">404</h1>
    <h2 style="font-size:2rem;font-weight:bold;margin:1rem">Esta página no existe</h2>
    <p style=" font-family: 'Nunito'; font-size:1.5rem">La página a la que se intento acceder no
    existe o no esta disponible por el momento. Puedes volver a la página anterior o ir al inicio.
    </p>
    <a> <button onclick="history.back(-1)" class="btn green">Volver</button></a>
    <a href="/"> <button style="margin-left:5rem" class="btn green">Inicio</button></a>


</div>
