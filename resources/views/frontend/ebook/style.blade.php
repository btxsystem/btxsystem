<style>
    div#flag {
        background-color: #333;
        padding: 10px;
        font-size: 16px !important;
        border-radius: 2px;
        -ms-transform: rotate(40deg);
        -webkit-transform: rotate(40deg);
        transform: rotate(40deg);
        width: 160px;
        text-align: center;
        position: absolute;
        right: -8%;
        height: 73px;
        z-index: 0;
        top: -30px;
        background-color: #D4AF37;
    }
    #flag span {
        position: relative;
        left: 18px;
        top: 30px;
    }
    .triangle{
        overflow: hidden;
        position: relative;
    }
    #clock-advance{
        color: #1C17D5;
        font-size: 14px;
    }
    #clock-basic{
        color: #1C17D5;
        font-size: 14px;
    }
    .clockdiv{
    	font-family: sans-serif;
    	color: #fff;
    	display: inline-block;
    	font-weight: bold;
    	text-align: center;
    	font-size: 18px;
    }

    .clockdiv > div{
    	padding: 6px;
    	border-radius: 3px;
    	background: #00BF96;
    	display: inline-block;
    }

    .clockdiv div > span{
    	padding: 8px;
    	border-radius: 3px;
    	background: #00816A;
    	display: inline-block;
    }

    .smalltext{
    	padding-top: 5px;
    	font-size: 12px;
    }
    @media only screen and (min-width: 992px) {
    	.triangle{
    		overflow: hidden;
    		position: relative;
    	}
    	.clockdiv{
    		font-family: sans-serif;
    		color: #fff;
    		display: inline-block;
    		font-weight: bold;
    		text-align: center;
    		font-size: 20px;
    	}

    	.clockdiv > div{
    		padding: 10px;
    		border-radius: 3px;
    		background: #00BF96;
    		display: inline-block;
    	}

    	.clockdiv div > span{
    		padding: 15px;
    		border-radius: 3px;
    		background: #00816A;
    		display: inline-block;
    	}

    	.smalltext{
    		padding-top: 5px;
    		font-size: 15px;
    	}

        #advance-photo,#basic-photo{
            width 110px;
        } 
    }
</style>
