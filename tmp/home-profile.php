<?php if ( !defined( 'ABSPATH' ) ) exit; ?>
<section id="about">
  <div class="daifuk-profile-layout">
    <div class="daifuk-profile-text">
      <span class="daifuk-profile-role">CREATOR & DESIGNER</span>
      <h2 class="daifuk-profile-title">ユウタ ダイフク</h2>
      <p class="daifuk-profile-description">
        広告制作会社でデザイナーとして経験を積み、現在はフリーランスとしてWeb制作やデザインに携わっています。<br>
        生成AIの登場により、これまで技術的な理由で諦めていた「つくる」ためのハードルが劇的に下がりました。このブログでは、広告デザイン・AI活用・Web制作のプロセスを、成功も失敗も含めてリアルに記録・発信しています。
      </p>
      <a href="/about/" class="daifuk-btn daifuk-btn-primary">詳しいプロフィールを見る</a>
    </div>
    <div class="daifuk-profile-avatar-wrap">
      <?php
      $avatar_url = get_avatar_url( 1, array( 'size' => 400 ) );
      if ( $avatar_url ) : ?>
        <img src="<?php echo esc_url( $avatar_url ); ?>" alt="ユウタ">
      <?php else : ?>
        <span style="color: var(--text-light); font-size: 0.85rem;">[Avatar Photo]</span>
      <?php endif; ?>
    </div>
  </div>
</section>
