<?php if ( !defined( 'ABSPATH' ) ) exit; ?>
<section id="about" class="daifuk-section-gray">
  <div class="daifuk-section-inner">
    <div class="daifuk-profile-layout">
      <div class="daifuk-profile-avatar-wrap">
        <?php
        $avatar_url = get_avatar_url( 1, array( 'size' => 400 ) );
        if ( $avatar_url ) : ?>
          <img src="<?php echo esc_url( $avatar_url ); ?>" alt="ユウタ">
        <?php else : ?>
          <span style="color: var(--text-light); font-size: 0.85rem;">[Avatar Photo]</span>
        <?php endif; ?>
      </div>
      <div class="daifuk-profile-text">
        <span class="daifuk-profile-role">CREATOR & DESIGNER</span>
        <h2 class="daifuk-profile-title">ユウタ ダイフク</h2>
        <p class="daifuk-profile-description">
          広告制作会社でグラフィック・広告デザイナーとして培ったスキルをベースに、現在はAIをクリエイティブの武器としてフル活用。WordPressやモダンな静的Web制作、生成AIを活用した業務効率化プロセスなどを発信・提案しています。
        </p>
        <div class="daifuk-profile-bullets">
          <span>🎨 広告デザイナー</span>
          <span>🤖 生成AIの利活用</span>
          <span>💻 Web制作 (WordPress/静的サイト)</span>
        </div>
        <a href="/about/" class="daifuk-btn daifuk-btn-primary">詳しいプロフィールを見る</a>
      </div>
    </div>
  </div>
</section>
