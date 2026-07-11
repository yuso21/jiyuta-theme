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
          <span>
            <svg class="daifuk-badge-icon" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 14.7255 3.09032 17.1962 4.85857 19C5.03345 19.1749 5.29302 19.2439 5.53421 19.18C5.77539 19.1161 5.96191 18.9296 6.0258 18.6884C6.18247 18.0963 6.72147 17.6667 7.33333 17.6667H8.66667C9.77124 17.6667 10.6667 18.5621 10.6667 19.6667V20.6667C10.6667 21.2189 11.1144 21.6667 11.6667 21.6667C11.7788 21.6667 11.89 21.6441 12 22Z"/><circle cx="7.5" cy="10.5" r="1" fill="currentColor"/><circle cx="11.5" cy="7.5" r="1" fill="currentColor"/><circle cx="16.5" cy="9.5" r="1" fill="currentColor"/></svg>
            広告デザイナー
          </span>
          <span>
            <svg class="daifuk-badge-icon" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L15 9L22 12L15 15L12 22L9 15L2 12L9 9Z"/></svg>
            生成AIの利活用
          </span>
          <span>
            <svg class="daifuk-badge-icon" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
            Web制作 (WordPress/静的サイト)
          </span>
        </div>
        <a href="/about/" class="daifuk-btn daifuk-btn-primary">詳しいプロフィールを見る</a>
      </div>
    </div>
  </div>
</section>
