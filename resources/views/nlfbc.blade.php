<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <title>Hymn Collection</title>
    <style>
        /* --- Reset & Base --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #f5f1eb;
            color: #1e1e1e;
            padding: 16px;
            min-height: 100vh;
        }

        /* --- Page Cards --- */
        .page {
            background: white;
            padding: 24px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }
        .page:last-child {
            margin-bottom: 0;
        }

        /* --- Print / PDF Page Breaks --- */
        @media print {
            body { background: white; padding: 0; }
            .page {
                box-shadow: none;
                border-radius: 0;
                padding: 40px 50px;
                margin: 0;
                max-width: 100%;
                page-break-after: always;
            }
            .page:last-child { page-break-after: auto; }
            .back-link { border-color: #333; color: #333; }
            .back-link:hover { background: #333; color: white; }
            .toc-list a { color: #1a3b5d; }
        }

        /* --- Table of Contents --- */
        .toc {
            text-align: center;
            padding: 20px 10px;
        }
        .toc h1 {
            font-size: clamp(24px, 5vw, 34px);
            letter-spacing: 1.5px;
            color: #2c3e50;
            margin-bottom: 6px;
            font-weight: 700;
            border-bottom: 3px double #b8860b;
            display: inline-block;
            padding-bottom: 10px;
        }
        .toc-sub {
            font-size: clamp(14px, 2vw, 17px);
            color: #5d6d7e;
            margin-bottom: 24px;
            font-style: italic;
        }
        .toc-list {
            list-style: none;
            max-width: 500px;
            margin: 0 auto 16px auto;
            text-align: left;
            padding: 0;
        }
        .toc-list li {
            font-size: clamp(17px, 2.5vw, 21px);
            padding: 10px 0;
            border-bottom: 1px dashed #ddd;
        }
        .toc-list li:last-child {
            border-bottom: none;
        }
        .toc-list a {
            text-decoration: none;
            color: #1a3b5d;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 4px 8px;
            transition: color 0.2s;
            -webkit-tap-highlight-color: transparent;
        }
        .toc-list a:active {
            color: #b8860b;
        }
        .toc-list .page-num {
            font-size: clamp(13px, 1.6vw, 16px);
            color: #7f8c8d;
            font-weight: 400;
            white-space: nowrap;
        }
        .toc-list .title {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }
        .toc-list .title .icon {
            font-size: clamp(16px, 2vw, 20px);
            flex-shrink: 0;
        }
        .toc-note {
            font-size: clamp(12px, 1.4vw, 14px);
            color: #95a5a6;
            margin-top: 20px;
        }

        /* --- Devotional Page --- */
        .devotional-page {
            text-align: center;
            padding: 20px 14px;
        }
        .devotional-page .devotional-title {
            font-size: clamp(20px, 4vw, 28px);
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 24px;
            letter-spacing: 1.5px;
            border-bottom: 2px solid #e8ddd0;
            display: inline-block;
            padding-bottom: 8px;
        }
        .devotional-page .response {
            font-size: clamp(16px, 2.2vw, 20px);
            line-height: 2;
            color: #2c3e50;
            max-width: 700px;
            margin: 0 auto 6px auto;
            padding: 0 4px;
        }
        .devotional-page  .amen {
            font-weight: 700;
            color: #b8860b;
        }
        .devotional-page .divider-line {
            width: 60px;
            height: 2px;
            background: #d5c7b5;
            margin: 14px auto;
        }
        .devotional-page .amen-line {
            font-size: clamp(22px, 4vw, 30px);
            font-weight: 700;
            letter-spacing: 4px;
            color: #b8860b;
            margin-top: 16px;
        }
        .page-number {
            text-align: right;
            font-size: clamp(12px, 1.4vw, 14px);
            color: #bbb;
            margin-bottom: 8px;
        }

        /* --- Hymn Pages --- */
        .hymn-title {
            font-size: clamp(22px, 4.5vw, 32px);
            font-weight: 700;
            text-align: center;
            color: #2c3e50;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }
        .hymn-sub {
            text-align: center;
            font-size: clamp(12px, 1.4vw, 15px);
            color: #7f8c8d;
            margin-bottom: 20px;
            font-style: italic;
        }
        .hymn-body {
            font-size: clamp(16px, 2vw, 19px);
            line-height: 1.9;
            white-space: pre-line;
            font-family: 'Georgia', serif;
            word-wrap: break-word;
        }
        .hymn-body .verse-label {
            font-weight: 700;
            color: #b8860b;
            margin-top: 10px;
            display: block;
        }
        .hymn-body .chorus-label {
            font-weight: 700;
            font-style: italic;
            color: #1a3b5d;
            margin-top: 8px;
            display: block;
        }
        .hymn-body .chorus {
            font-style: italic;
            color: #1e3a5f;
        }

        /* --- Responsive Reading --- */
        .responsive-reading {
            font-size: clamp(15px, 2vw, 18px);
            line-height: 1.8;
            font-family: 'Georgia', serif;
        }
        .responsive-reading p {
            margin: 0;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .rv-leader {
            background: #eaf0fb;
            color: #1a3b5d;
        }
        .rv-cong {
            background: #fdf6e3;
            color: #7a5800;
        }
        .rv-num {
            font-weight: 700;
            margin-right: 6px;
            font-size: 0.85em;
            opacity: 0.7;
        }

        /* --- Back Link --- */
        .back-link {
            display: inline-block;
            margin-top: 30px;
            color: #b8860b;
            text-decoration: none;
            font-size: clamp(14px, 1.6vw, 16px);
            border: 1px solid #b8860b;
            padding: 6px 18px;
            border-radius: 30px;
            transition: 0.2s;
            -webkit-tap-highlight-color: transparent;
        }
        .back-link:active {
            background: #b8860b;
            color: white;
        }

        /* --- Footer --- */
        .footer-note {
            text-align: center;
            font-size: clamp(11px, 1.2vw, 13px);
            color: #95a5a6;
            margin-top: 24px;
            border-top: 1px solid #eaeaea;
            padding-top: 16px;
        }

        /* --- Touch-friendly spacing --- */
        .toc-list li a {
            padding: 4px 0;
        }
        .toc-list li a:active {
            opacity: 0.7;
        }
        .devotional-subtitle {
            display: block;
            font-size: 0.9em;
            font-weight: normal;
            opacity: 0.7;
            margin-top: 4px;
            line-height: 1.4;
            padding-left: 2em;
        }

        /* --- Large screens (desktop) --- */
        @media (min-width: 768px) {
            body { padding: 40px 20px; }
            .page { padding: 40px 50px; margin-bottom: 32px; }
            .toc { padding: 20px 10px; }
            .devotional-page { padding: 30px 20px; }
        }

        /* --- Small screens --- */
        @media (max-width: 480px) {
            body { padding: 10px; }
            .page { padding: 16px 14px; margin-bottom: 16px; border-radius: 6px; }
            .toc-list li { padding: 8px 0; }
            .devotional-page .response { line-height: 1.8; }
            .hymn-body { line-height: 1.7; }
            .back-link { padding: 8px 16px; margin-top: 20px; }
        }

        /* --- Very small screens --- */
        @media (max-width: 360px) {
            .page { padding: 12px 10px; }
            .toc h1 { font-size: 20px; }
            .toc-list li { font-size: 15px; padding: 6px 0; }
            .hymn-body { font-size: 14px; }
            .devotional-page .response { font-size: 14px; }
        }
    </style>
</head>
<body>

    <!-- ============================================================ -->
    <!-- PAGE 1 – ORDER OF WORSHIP                                      -->
    <!-- ============================================================ -->
    <div class="page toc" id="toc-page">
    <h1>NLFBC 17th Year Anniversary</h1>
    <p class="toc-sub">Order of Worship</p>

    <ul class="toc-list">
        <li><a href="#toc-page"><span class="title"><span class="icon">👨‍👩‍👧‍👦</span>Welcome and Announcement</span><span class="page-num"></span></a></li>
        <li><a href="#welcome-newness"><span class="title"><span class="icon">🎵</span>Welcome to Newness of Life</span><span class="page-num">p. 2</span></a></li>
        <li><a href="#call-to-worship"><span class="title"><span class="icon">📖</span>Call to Worship — Romans 12:1-2</span><span class="page-num">p. 3</span></a></li>
        <li><a href="#scripture-reading"><span class="title"><span class="icon">📖</span>Scripture Text Reading — Acts 4:1-21</span><span class="page-num">p. 4</span></a></li>
        <li>
            <span class="title"><span><span class="icon">🎵 </span>Worship Hymns
                <small class="devotional-subtitle">
                    <a href="#devotional-page" style="display:flex;justify-content:space-between;color:inherit;text-decoration:none">· Devotional Responses <span style="color:#7f8c8d">p. 5</span></a>
                    <a href="#hymn1" style="display:flex;justify-content:space-between;color:inherit;text-decoration:none">· Praise Him! Praise Him! <span style="color:#7f8c8d">p. 6</span></a>
                    <a href="#hymn2" style="display:flex;justify-content:space-between;color:inherit;text-decoration:none">· To God Be the Glory <span style="color:#7f8c8d">p. 7</span></a>
                    <a href="#hymn3" style="display:flex;justify-content:space-between;color:inherit;text-decoration:none">· The Banner of the Cross <span style="color:#7f8c8d">p. 8</span></a>
                    <a href="#hymn4" style="display:flex;justify-content:space-between;color:inherit;text-decoration:none">· How Great Thou Art <span style="color:#7f8c8d">p. 9</span></a>
                </small>
            </span></span>
        </li>
        <li><a href="#worship-substance"><span class="title"><span class="icon">📖</span>Worship in Substance — 2 Cor 9:6-8</span><span class="page-num">p. 10</span></a></li>
        <li><a href="#trust-me"><span class="title"><span class="icon">🎵</span>Trust Me, Try Me, Prove Me</span><span class="page-num">p. 11</span></a></li>
        <li>
            <span class="title"><span><span class="icon">🎵 </span>Speacial Song Offering
                <small class="devotional-subtitle">
                    <ul style="list-style:disc;padding-left:4em;margin:4px 0;font-size:0.75em;opacity:0.7">
                        <li><small>Sister Che</small></li>
                        <li><small>NLFBC Jeddah</small></li>
                        <li><small>NLFBC Thuwal</small></li>
                    </ul>
                </small>
            </span></span>
        </li>
        <li><a href="#trust-me"><span class="title"><span class="icon">👤</span>Testimony </span><span class="page-num"></span></a></li>
        <li><a href="#"><span class="title"><span class="icon">📖</span>Final Announcement</span><span class="page-num"></span></a></li>
        <li><a href="#hymn5"><span class="title"><span class="icon">🎵</span>Closing Hymn — Jesus Saves</span><span class="page-num">p. 12</span></a></li>
        <li><a href="#"><span class="title"><span class="icon">🙏</span>Closing prayer</span><span class="page-num"></span></a></li>
    </ul>

    <div class="toc-note">✦ Click a title to jump to the page ✦</div>
    <div class="footer-note"> — Prepared for Personal Worship &amp; Reflection · NLFBC —</div>
</div>

    <!-- ============================================================ -->
    <!-- PAGE 2 – WELCOME TO NEWNESS OF LIFE                           -->
    <!-- ============================================================ -->
    <div class="page" id="welcome-newness">
        <div class="page-number">p. 2</div>
        <h2 class="hymn-title">Welcome to Newness of Life</h2>
        <div class="hymn-body">
Welcome to Newness of Life, It's a church where you belong
Welcome to Newness of Life, within our heart We sing a song
Our message is from God's word Of Christ the living way
Newness of Life welcome you Today
        </div>
        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 3 – CALL TO WORSHIP                                       -->
    <!-- ============================================================ -->
    <div class="page" id="call-to-worship">
        <div class="page-number">p. 3</div>
        <h2 class="hymn-title">Call to Worship</h2>
        <p class="hymn-sub">Romans 12:1-2</p>
        <div class="hymn-body">
I beseech you therefore, brethren, by the mercies of God, that ye present your bodies a living sacrifice, holy, acceptable unto God, which is your reasonable service.

And be not conformed to this world: but be ye transformed by the renewing of your mind, that ye may prove what is that good, and acceptable, and perfect, will of God.
        </div>
        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 4 – SCRIPTURE TEXT READING                                -->
    <!-- ============================================================ -->
    <div class="page" id="scripture-reading">
        <div class="page-number">p. 4</div>
        <h2 class="hymn-title">Scripture Text Reading</h2>
        <p class="hymn-sub">Acts 4:1-21</p>
        <p class="hymn-sub" style="margin-top:-12px;font-size:0.85em">
            <span style="display:inline-block;width:12px;height:12px;background:#1a3b5d;border-radius:2px;vertical-align:middle;margin-right:4px"></span>Leader &nbsp;&nbsp;
            <span style="display:inline-block;width:12px;height:12px;background:#b8860b;border-radius:2px;vertical-align:middle;margin-right:4px"></span>Congregation
        </p>
        <div class="responsive-reading">
            <p class="rv-leader"><span class="rv-num">1</span> And as they spake unto the people, the priests, and the captain of the temple, and the Sadducees, came upon them,</p>
            <p class="rv-cong"><span class="rv-num">2</span> Being grieved that they taught the people, and preached through Jesus the resurrection from the dead.</p>
            <p class="rv-leader"><span class="rv-num">3</span> And they laid hands on them, and put them in hold unto the next day: for it was now eventide.</p>
            <p class="rv-cong"><span class="rv-num">4</span> Howbeit many of them which heard the word believed; and the number of the men was about five thousand.</p>
            <p class="rv-leader"><span class="rv-num">5</span> And it came to pass on the morrow, that their rulers, and elders, and scribes,</p>
            <p class="rv-cong"><span class="rv-num">6</span> And Annas the high priest, and Caiaphas, and John, and Alexander, and as many as were of the kindred of the high priest, were gathered together at Jerusalem.</p>
            <p class="rv-leader"><span class="rv-num">7</span> And when they had set them in the midst, they asked, By what power, or by what name, have ye done this?</p>
            <p class="rv-cong"><span class="rv-num">8</span> Then Peter, filled with the Holy Ghost, said unto them, Ye rulers of the people, and elders of Israel,</p>
            <p class="rv-leader"><span class="rv-num">9</span> If we this day be examined of the good deed done to the impotent man, by what means he is made whole;</p>
            <p class="rv-cong"><span class="rv-num">10</span> Be it known unto you all, and to all the people of Israel, that by the name of Jesus Christ of Nazareth, whom ye crucified, whom God raised from the dead, even by him doth this man stand here before you whole.</p>
            <p class="rv-leader"><span class="rv-num">11</span> This is the stone which was set at nought of you builders, which is become the head of the corner.</p>
            <p class="rv-cong"><span class="rv-num">12</span> Neither is there salvation in any other: for there is none other name under heaven given among men, whereby we must be saved.</p>
            <p class="rv-leader"><span class="rv-num">13</span> Now when they saw the boldness of Peter and John, and perceived that they were unlearned and ignorant men, they marvelled; and they took knowledge of them, that they had been with Jesus.</p>
            <p class="rv-cong"><span class="rv-num">14</span> And beholding the man which was healed standing with them, they could say nothing against it.</p>
            <p class="rv-leader"><span class="rv-num">15</span> But when they had commanded them to go aside out of the council, they conferred among themselves,</p>
            <p class="rv-cong"><span class="rv-num">16</span> Saying, What shall we do to these men? for that indeed a notable miracle hath been done by them is manifest to all them that dwell in Jerusalem; and we cannot deny it.</p>
            <p class="rv-leader"><span class="rv-num">17</span> But that it spread no further among the people, let us straitly threaten them, that they speak henceforth to no man in this name.</p>
            <p class="rv-cong"><span class="rv-num">18</span> And they called them, and commanded them not to speak at all nor teach in the name of Jesus.</p>
            <p class="rv-leader"><span class="rv-num">19</span> But Peter and John answered and said unto them, Whether it be right in the sight of God to hearken unto you more than unto God, judge ye.</p>
            <p class="rv-cong"><span class="rv-num">20</span> For we cannot but speak the things which we have seen and heard.</p>
            <p class="rv-leader"><span class="rv-num">21</span> So when they had further threatened them, they let them go, finding nothing how they might punish them, because of the people: for all men glorified God for that which was done.</p>
        </div>
        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 5 – DEVOTIONAL RESPONSES                                  -->
    <!-- ============================================================ -->
    <div class="page devotional-page" id="devotional-page">
        <div class="page-number">p. 5</div>

        <div class="devotional-title">✠ Devotional Responses ✠</div>
        <div class="response">
            <span class="amen">Glory be to the Father.</span><br>
            Glory be to the Father and to the Son and to the Holy Ghost.<br />
            As it was in the beginning, is now and ever shall be, world without end. 
        </div>

        <div class="divider-line"></div>
        <span class="amen">The Lord is in his holy temple.</span>
        <div class="response">
            The Lord is in His holy temple, The Lord is in His holy temple.<br />
            Let all the earth keep silence, Let all the earth keep silence<br />
            Before Him, Keep silence, Keep silence before Him. 
        </div>

        <div class="divider-line"></div>
        <span class="amen">Hear our Prayer oh Lord.</span>
        <div class="response">
            Hear our Prayers oh Lord.<br />
            Hear our Prayers oh Lord.<br />
            Incline thine ears to us<br />
            and grant us thy peace. 
        </div>

        <div class="divider-line"></div>
        <span class="amen">Doxology.</span>
        <div class="response">
            Praise God, from Whom all blessings flow;<br />
            Praise Him, all creatures here below;<br />
            Praise Him above, ye heavenly host;<br />
            Praise Father, Son, and Holy Ghost. 
        </div>

        <div class="divider-line"></div>

        <div class="amen-line">Amen &nbsp;·&nbsp; Amen &nbsp;·&nbsp; Amen</div>

        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 6 – HYMN 1: Praise Him! Praise Him!                       -->
    <!-- ============================================================ -->
    <div class="page" id="hymn1">
        <div class="page-number">p. 6</div>
        <h2 class="hymn-title">Praise Him! Praise Him!</h2>
       
        <div class="hymn-body">
            <span class="verse-label">[1]</span>
            Praise Him! Praise Him! Jesus, our blessèd Redeemer!
            Sing, O Earth, His wonderful love proclaim!
            Hail Him! hail Him! highest archangels in glory;
            Strength and honor give to His holy Name!
            Like a shepherd, Jesus will guard His children,
            In His arms He carries them all day long:

            <span class="chorus-label">[chorus]</span>
            <span class="chorus">Praise Him! Praise Him!
            Tell of His excellent greatness.
            Praise Him! Praise Him!
            Ever in joyful song!</span>

            <span class="verse-label">[2]</span>
            Praise Him! Praise Him! Jesus, our blessèd Redeemer!
            For our sins He suffered, and bled, and died.
            He our Rock, our hope of eternal salvation,
            Hail Him! hail Him! Jesus the Crucified.
            Sound His praises! Jesus who bore our sorrows,
            Love unbounded, wonderful, deep and strong.

            <span class="verse-label">[3]</span>
            Praise Him! Praise Him! Jesus, our blessèd Redeemer!
            Heav'nly portals loud with hosannas ring!
            Jesus, Savior, reigneth forever and ever.
            Crown Him! Crown Him! Prophet, and Priest, and King!
            Christ is coming! over the world victorious,
            Pow'r and glory unto the Lord belong.
        </div>

        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 7 – HYMN 2: To God Be the Glory                          -->
    <!-- ============================================================ -->
    <div class="page" id="hymn2">
        <div class="page-number">p. 7</div>
        <h2 class="hymn-title">To God Be the Glory</h2>
       

        <div class="hymn-body">
            <span class="verse-label">[1]</span>
            To God be the glory, great things He has done;
            So loved He the world that He gave us His Son,
            Who yielded His life an atonement for sin,
            And opened the life gate that all may go in.

            <span class="chorus-label">[chorus]</span>
            <span class="chorus">Praise the Lord, praise the Lord,
            Let the earth hear His voice!
            Praise the Lord, praise the Lord,
            Let the people rejoice!
            O come to the Father, through Jesus the Son,
            And give Him the glory, great things He has done.</span>

            <span class="verse-label">[2]</span>
            O perfect redemption, the purchase of blood,
            To every believer the promise of God;
            The vilest offender who truly believes,
            That moment from Jesus a pardon receives.

            <span class="verse-label">[3]</span>
            Great things He has taught us, great things He has done,
            And great our rejoicing through Jesus the Son;
            But purer, and higher, and greater will be
            Our wonder, our transport, when Jesus we see.
        </div>

        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 8 – HYMN 3: The Banner of the Cross                      -->
    <!-- ============================================================ -->
    <div class="page" id="hymn3">
        <div class="page-number">p. 8</div>
        <h2 class="hymn-title">The Banner of the Cross</h2>
       
        <div class="hymn-body">
            <span class="verse-label">[1]</span>
            There's a royal banner given for display
            To the soldiers of the King;
            As an ensign fair we lift it up today,
            While as ransomed ones we sing.

            <span class="chorus-label">[chorus]</span>
            <span class="chorus">Marching on, marching on,
            For Christ count ev'rything but loss!
            And to crown Him King,
            toil and sing 'Neath the banner of the cross!</span>

            <span class="verse-label">[2]</span>
            Though the foe may rage and gather as the flood,
            Let the standard be displayed;
            And beneath its folds, as soldiers of the Lord,
            For the truth be not dismayed!
            <span class="chorus">(Repeat Chorus)</span>

            <span class="verse-label">[3]</span>
            Over land and sea, wherever man may dwell,
            Make the glorious tidings known;
            Of the crimson banner now the story tell,
            While the Lord shall claim His own!
            <span class="chorus">(Repeat Chorus)</span>
        </div>

        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 9 – HYMN 4: How Great Thou Art                           -->
    <!-- ============================================================ -->
    <div class="page" id="hymn4">
        <div class="page-number">p. 9</div>
        <h2 class="hymn-title">How Great Thou Art</h2>
        

        <div class="hymn-body">
            <span class="verse-label">[1]</span>
            O Lord my God, When I in awesome wonder,
            Consider all the worlds Thy Hands have made;
            I see the stars, I hear the rolling thunder,
            Thy power throughout the universe displayed.

            <span class="chorus-label">[chorus]</span>
            <span class="chorus">Then sings my soul, My Saviour God, to Thee,
            How great Thou art, How great Thou art.
            Then sings my soul, My Saviour God, to Thee,
            How great Thou art, How great Thou art!</span>

            <span class="verse-label">[2]</span>
            When through the woods, and forest glades I wander,
            And hear the birds sing sweetly in the trees.
            When I look down, from lofty mountain grandeur
            And see the brook, and feel the gentle breeze.

            <span class="verse-label">[3]</span>
            And when I think, that God, His Son not sparing;
            Sent Him to die, I scarce can take it in;
            That on the Cross, my burden gladly bearing,
            He bled and died to take away my sin.

            <span class="verse-label">[4]</span>
            When Christ shall come, with shout of acclamation,
            And take me home, what joy shall fill my heart.
            Then I shall bow, in humble adoration,
            And then proclaim: "My God, how great Thou art!"
        </div>

        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 10 – WORSHIP IN SUBSTANCE                                 -->
    <!-- ============================================================ -->
    <div class="page" id="worship-substance">
        <div class="page-number">p. 10</div>
        <h2 class="hymn-title">Worship in Substance</h2>
        <p class="hymn-sub">2 Corinthians 9:6-8</p>
        <div class="hymn-body">
But this I say, He which soweth sparingly shall reap also sparingly; and he which soweth bountifully shall reap also bountifully.

Every man according as he purposeth in his heart, so let him give; not grudgingly, or of necessity: for God loveth a cheerful giver.

And God is able to make all grace abound toward you; that ye, always having all sufficiency in all things, may abound to every good work.
        </div>
        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 11 – TRUST ME, TRY ME, PROVE ME                          -->
    <!-- ============================================================ -->
    <div class="page" id="trust-me">
        <div class="page-number">p. 11</div>
        <h2 class="hymn-title">Trust Me, Try Me, Prove Me</h2>
        <div class="hymn-body">
            <span class="verse-label">[1]</span>
Bring ye all the tithes into the storehouse,
All your money, talents, time and love;
Consecrate them all upon the altar,
While your Savior from above speaks sweetly,

            <span class="chorus-label">[chorus]</span>
            <span class="chorus">Trust Me, try Me, prove Me, saith the Lord of hosts, and see
If a blessing, unmeasured blessing,
I will not pour out on thee.</span>

            <span class="verse-label">[2]</span>
When my wav'ring faith, in trials, falters,
When His guiding hand I cannot see,
Then in wondrous love and tender mercy,
Through His Word He says to me,
My child, just

            <span class="verse-label">[3]</span>
I have yielded Him my life forever,
All I am, or have or hope to be;
Naught on earth my hold on Him can sever,
While I hear Him say to me,
My child, just
        </div>
        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

    <!-- ============================================================ -->
    <!-- PAGE 12 – HYMN 5: Jesus Saves                                 -->
    <!-- ============================================================ -->
    <div class="page" id="hymn5">
        <div class="page-number">p. 12</div>
        <h2 class="hymn-title">Jesus Saves</h2>
        

        <div class="hymn-body">
            <span class="verse-label">[1]</span>
            We have heard the joyful sound: Jesus saves! Jesus saves!
            Spread the tidings all around: Jesus saves! Jesus saves!
            Bear the news to every land, Climb the steeps and cross the waves;
            Onward! 'tis our Lord's command; Jesus saves! Jesus saves!

            <span class="verse-label">[2]</span>
            Waft it on the rolling tide: Jesus saves! Jesus saves!
            Tell to sinners far and wide: Jesus saves! Jesus saves!
            Sing, you islands of the sea; Echo back, you ocean caves;
            Earth shall keep her jubilee: Jesus saves! Jesus saves!

            <span class="verse-label">[3]</span>
            Sing above the battle strife: Jesus saves! Jesus saves!
            By His death and endless life, Jesus saves! Jesus saves!
            Shout it brightly through the Gloom, when the heart for mercy craves;
            Sing in triumph o'er the tomb: Jesus saves! Jesus saves!

            <span class="verse-label">[4]</span>
            Give the winds a mighty voice: Jesus saves! Jesus saves!
            Let the nations now rejoice: Jesus saves! Jesus saves!
            Shout salvation full and free; Highest hills and deepest caves;
            This our song of victory: Jesus saves! Jesus saves!
        </div>

        <a href="#toc-page" class="back-link">⬅ Back to Contents</a>
    </div>

</body>
</html>