<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, "San Francisco", Helvetica, Arial, sans-serif;
    font-weight: 300;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f3f2f2;
}

.session {
    display: flex;
    width: 100%;
    max-width: 800px;
    background-color: #ffffff;
    box-shadow: 0px 2px 6px -1px rgba(0,0,0,.12);
    border-radius: 4px;
}

.left {
    flex: 1;
    padding: 20px;
    background-image: url("https://images.pexels.com/photos/114979/pexels-photo-114979.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
    background-size: cover;
}

.log-in {
    flex: 1;
    padding: 40px 30px;
}

h4 {
    font-size: 24px;
    font-weight: 600;
    color: #000;
    opacity: 0.85;
    margin-bottom: 20px;
}

p {
    font-size: 14px;
    line-height: 1.5;
    color: #000;
    opacity: 0.65;
    margin-bottom: 20px;
}

input {
    width: 100%;
    height: 50px;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid rgba(0,0,0,0.1);
}

button {
    width: 100%;
    height: 50px;
    border: none;
    border-radius: 25px;
    background-color: pink;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s ease;
}

button:hover {
    transform: translateY(-3px);
}

.icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
}

.discrete {
    color: rgba(0,0,0,0.4);
    font-size: 14px;
    text-decoration: none;
    margin-top: 20px;
    display: block;
    text-align: center;
}

    </style>